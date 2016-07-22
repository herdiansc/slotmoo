<?php
App::uses('AppController', 'Controller');
/**
 * Listings Controller
 *
 * @property Listing $Listing
 */
class ListingsController extends AppController {

	public $allowedImages = array(3,2);
	public $image_extentions = array(
		3=>"png",
		2=>"jpg"
	);
	
	public $components = array('RequestHandler');
	
	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('browse','search');
		$this->Security->unlockedFields = array('keyword','error','name','size','type','tmp_name');
	}
	
	function search() {
        if(sizeof($this->params['url']) > 1) {
            $queryString = $this->params['url'];
            unset($queryString['url']);
            $get = Router::queryString($queryString);
        }else {
            $get = null;
        }
        
	    $this->paginate = array(
	        'limit'=>10,
	        'conditions'=>array(
                'OR'=>array(
                    'Listing.title LIKE '=>'%'. @$this->params['url']['string'] .'%',
                    'Listing.description LIKE '=>'%'. @$this->params['url']['string'] .'%'
                )	        
	        ),
	        'order'=>'Listing._visit DESC'
        );
	    $listings = $this->paginate('Listing');
        $title_for_layout = 'Pencarian '.$this->params['url']['string'];
        $this->set(compact('listings','title_for_layout','get'));
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
        $sortingParams = $this->getSortingParams();
        $this->set('get',$sortingParams['get']);

        $ids = $this->Listing->KeywordListing->Keyword->Follow->find('list',array(
            'conditions'=>array('Follow.user_id'=>$this->Session->read('Auth.User.id')),
            'fields'=>array('Follow.keyword_id'),
            'recursive'=>-1
        ));
        if($ids == null) $ids = array(0);

	    $this->paginate = array(
	        'order'=>$sortingParams['o'],
	        'conditions'=>array(
	            'OR'=>array(
	                'Listing.user_id'=>$this->Session->read('Auth.User.id'),
	                'KeywordListing.keyword_id IN('. implode(',',$ids) .')'
	                
	            )
	        ),
	        'group'=>array('Listing.id'),
	        'recursive'=>2,
	        'contain'=>array('Keyword','Listing'=>array('User'))
	    );


	    $listings = $this->paginate('KeywordListing');;


#	    debug($listings);

		$user['info'] = $this->Listing->User->findSummary($this->Auth->user('id'));
		$this->set(compact('user','listings'));
	}
	
/**
 * index method
 *
 * @return void
 */
	public function browse() {

        $sortingParams = $this->getSortingParams();
        $this->set('get',$sortingParams['get']);

        $this->Listing->virtualFields['_image_count'] = 'SELECT IF(count(*) > 0, 1, 0) FROM image_listings il WHERE il.listing_id = Listing.id';
        $this->Listing->virtualFields['_keyword_count'] = 'SELECT IF(count(*) > 0, 1, 0) FROM keyword_listings kl WHERE kl.listing_id = Listing.id';

        $sortingParams['o'] = @$_GET['o'] == null ? 'Listing._image_count DESC, Listing._keyword_count DESC, Listing.created DESC' : $_GET['o'] ;  

		$this->Listing->recursive = 0;
	    $this->paginate = array(
	        'order'=>$sortingParams['o'],
	        'recursive'=>1,
	        'contain'=>array(
	            'User'=>array('fields'=>array(
	                'User.username','User.slug','User.photo_profile',
	                'User.image_server','User.display_name'
	                )
	            ),
	            'KeywordListing'
            )
	    );
	    $listings = $this->paginate();
	    
		$this->set('listings', $listings);
		
		$specials = $this->Listing->find('all',array(
		    'conditions'=>array('or'=>array('Listing.is_hot'=>1,'Listing.is_featured'=>1)),
		    'order'=>array('Listing.id DESC'),
	        'limit'=>20,
	        'recursive'=>1,
	        'contain'=>array(
	            'User'=>array('fields'=>array(
	                'User.username','User.slug','User.photo_profile',
	                'User.image_server','User.display_name'
	                )
	            ),
	            'KeywordListing'
            )		    
		));
		$this->set('specials', $specials);
		
		$this->Listing->KeywordListing->Keyword->virtualFields['_listings_count'] = 'SELECT COUNT(*) FROM keyword_listings WHERE keyword_listings.keyword_id = Keyword.id';
		$keywords = $this->Listing->KeywordListing->Keyword->find('all',array(
		    'conditions'=>array(),
		    'limit'=>10,
		    'order'=>array('Keyword.rank DESC','Keyword._listings_count DESC'),
		    'recursive'=>-1
		));
		//debug($keywords);
        $this->set('keywords', $keywords);
#debug($listings);		
#		$user['info'] = $this->Listing->User->findSummary($this->Auth->user('id'));
#		$this->set(compact('user'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
        $id = $this->params['id'];
		$options = array(
			'conditions' => array('Listing.' . $this->Listing->primaryKey => $id),
		);
		$listing = Cache::read('view_listing_'.$id);
		if( !$listing ){
		    $listing = $this->Listing->find('first', $options);
		    if (empty($listing) || $listing == null) {
			    throw new NotFoundException('Iklan tidak ditemukan');
		    }		    
		    Cache::write('view_listing_'.$id,$listing);
		}
        $this->paginate = array(
            'limit'=>10,
            'conditions'=>array(
                'Comment.listing_id'=>$id
            ),
            'recursive'=>-1,
            'order'=>'Comment.created ASC',
        );
        $comments = $this->paginate('Comment');
#		$user['info'] = $this->Listing->User->findSummary($this->Auth->user('id'));
		$user['info'] = $this->Listing->User->findSummary($listing['Listing']['user_id']);
		$this->set(compact('user','comments','listing'));
		
		$this->setSiteMeta(array(
		    'title'=>h($listing['Listing']['title']),
            'description'=>h($listing['Listing']['description']),
            'keywords'=>$this->setKeywords($listing['KeywordListing'])
        ));
		
        $visit = array(
            'ip_address'=>$this->RequestHandler->getClientIP(),
            'listing_id'=>$listing['Listing']['id'],
            'referer'=>@$_SERVER['HTTP_REFERER']
        );
        $this->Listing->ListingVisit->save($visit);
        
        if($this->Auth->user('id')) {
            $ids = $this->Listing->KeywordListing->Keyword->Follow->find('list',array(
                'conditions'=>array('Follow.user_id'=>$this->Session->read('Auth.User.id')),
                'fields'=>array('Follow.keyword_id'),
                'recursive'=>-1
            ));
            if($ids == null) $ids = array(0);
        }else {
            $ids = array(0);
        }
        $this->set(compact('ids'));
	}
	
	function setKeywords($keywords=array()) {
	    $imploded_keywords=null;
	    foreach($keywords as $keyword) {
	        $imploded_keywords .= $keyword['_keyword_name'].',';
	    }
	    return $imploded_keywords.SITE_KEYWORDS;
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
		
            if(isset($_POST['keyword'])) {
                $old = array();
                $new = array();
                foreach($_POST['keyword'] as $topic) {
                    $topic = json_decode(stripslashes($topic),true);
                    if(!isset($topic['id'])) {
                        $new[] = $topic['label'];
                    }else {
                        $this->request->data['KeywordListing'][] = array('keyword_id'=>$topic['id']);
                    }
                }
            }
		
			$this->request->data['Listing']['user_id'] = $this->Session->read('Auth.User.id');
			
			$images = $this->Session->read('AdImages');
			if(sizeof($images) > 0) {
			    $i = 0;
			    foreach($images as $image) {
				    $this->request->data['ImageListing'][$i]['filename'] = $image['filename'];
				    $this->request->data['ImageListing'][$i]['image_server'] = $image['CDN'];
				    if($i==0) $this->request->data['ImageListing'][$i]['is_default'] = 1;
				    $i++;
			    }
			}
			
			$this->Listing->create();
			if ($this->Listing->saveAll($this->request->data)) {
			
			
                if(!empty($new)) {
                    $t = array();
                    foreach($new as $nt) {
                        $t[] = array(
                            'Keyword'=>array('name'=>$nt,'slug'=>Inflector::slug($nt,'-')),
                            'KeywordListing'=>array(
                                array('listing_id'=>$this->Listing->getLastInsertID())
                            )
                        );
                    }
                    
                    
                    $savings = array();
                    foreach($t as $a) {
                        $this->Listing->KeywordListing->Keyword->create();
                        $savings[] = $this->Listing->KeywordListing->Keyword->saveAll($a);
                    }
                }
			
			    $this->Session->delete('AdImages');
				$this->Session->setFlash('Iklan berhasil disimpan.');
				$this->redirect('/');
			} else {
				$this->Session->setFlash('Maaf, iklan anda gagal disimpan.');
			}
		}else {
            $this->prepare_session_images();
		}

		$user['info'] = $this->Listing->User->findSummary($this->Auth->user('id'));
		$this->set(compact('user'));
	}
	
	
	function prepare_session_images() {
	    $session_images = $this->Session->read('AdImages');
	    if(!empty($session_images)) {
	        $path = WWW_ROOT.'uploads'.DS;
	        $in_images = array();
	        foreach($session_images as $k=>$v) {
	            if( is_file($path . $session_images[ $k ]['filename']) ){
	                $in_images[] = $session_images[ $k ]['filename'];
	            }else {
	                $this->Session->delete('AdImages.'.Inflector::slug($session_images[ $k ]['filename']));
	            }
	        }
	        $images = $this->Listing->ImageListing->find('list',array(
	            'conditions'=>array('OR'=>array('ImageListing.filename'=>$in_images)),
	            'fields'=>array('ImageListing.filename')
	        ));
#	        debug($images);
            foreach($images as $image) $this->Session->delete('AdImages.'.Inflector::slug($image));		    
	    }
	}

/**
 * edit method 
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if ($this->request->is('post') || $this->request->is('put')) {
            if(isset($_POST['keyword'])) {
                $old = array();
                $new = array();
                $existed_ids = array();
                foreach($_POST['keyword'] as $topic) {
					$topic = json_decode(stripslashes($topic),true);
                    if(!isset($topic['existed_id'])) {
                        if(!isset($topic['id'])) {
                            $new[] = $topic['label'];
                        }else {
                            $this->request->data['KeywordListing'][] = array('keyword_id'=>$topic['id']);
                        }
                    }
                }
            }		
		    $listing_user_id = $this->Listing->field('user_id',array('Listing.id'=>$id));
		    
			$images = $this->Session->read('AdImages');
			$db_images = $this->Listing->ImageListing->find('list',array(
			    'conditions'=>array('ImageListing.listing_id'=>$id),
			    'fields'=>array('filename')
			));
			if(sizeof($images) > 0) {
			    $i = 0;
			    foreach($images as $image) {
			        if(!in_array($image['filename'],$db_images)) {
				        $this->request->data['ImageListing'][$i]['filename'] = $image['filename'];
				        $this->request->data['ImageListing'][$i]['image_server'] = $image['CDN'];
				        if($i==0 && empty($db_images)) $this->request->data['ImageListing'][$i]['is_default'] = 1;
			        }
				    $i++;
			    }
			}
		    
			if ($listing_user_id == $this->Session->read('Auth.User.id') && $this->Listing->saveAll($this->request->data)) {
				
                if(!empty($new)) {
                    $t = array();
                    foreach($new as $nt) {
                        $t[] = array(
                            'Keyword'=>array('name'=>$nt,'slug'=>Inflector::slug($nt,'-')),
                            'KeywordListing'=>array(
                                array('listing_id'=>$id)
                            )
                        );
                    }
                    
                    $savings = array();
                    foreach($t as $a) {
                        $this->Listing->KeywordListing->Keyword->create();
                        $savings[] = $this->Listing->KeywordListing->Keyword->saveAll($a);
                    }
                }
				
			    $this->Session->delete('AdImages');	
				$this->Session->setFlash('Iklan telah berhasil diubah.');
				Cache::delete('view_listing_'.$id);
			} else {
				$this->Session->setFlash('Maaf, iklan gagal diubah.');
			}
			$this->redirect('/');
		} else {
		    
		    $this->prepare_session_images();
		
		    $this->Listing->KeywordListing->virtualFields['_label'] = 'SELECT name FROM keywords WHERE keywords.id = KeywordListing.keyword_id';
			$options = array(
			    'conditions' => array(
			        'Listing.' . $this->Listing->primaryKey => $id,
			        'Listing.user_id'=>$this->Session->read('Auth.User.id')
			    )
		    );
			$this->request->data = $this->Listing->find('first', $options);
			$this->request->data['Listing']['description'] = str_replace('<br />','',$this->request->data['Listing']['description']);
			
			$db_images = $old_images = array();
			foreach($this->request->data['ImageListing'] as $image) {
			    $db_images[ Inflector::slug($image['filename']) ]['filename'] = $image['filename'];
			    $db_images[ Inflector::slug($image['filename']) ]['CDN'] = $image['image_server'];
			}
			$old_images = $this->Session->read('AdImages');
			$db_images = array_merge((array)$db_images,(array)$old_images);
			$this->Session->write('AdImages',$db_images);
		}

		$user['info'] = $this->Listing->User->findSummary($this->Auth->user('id'));
		$this->set(compact('user'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
	    $listing = $this->Listing->find('first',
	        array(
	            'conditions'=>array('Listing.id'=>$id,'Listing.user_id'=>$this->Session->read('Auth.User.id'))  
	        )
	    );
		if ($this->Listing->deleteAll(array('Listing.id'=>$id,'Listing.user_id'=>$this->Session->read('Auth.User.id')))) {
#        if (true) {
		    foreach($listing['ImageListing'] as $image){
                $exploded_filename = explode('.',$image['filename']);
                array_map( "unlink", glob(WWW_ROOT.'uploads'.DS.$exploded_filename[0].'*') );
		    }
			$this->Session->setFlash('Iklan telah berhasil dihapus');
		}else {
		    $this->Session->setFlash('Iklan gagal dihapus');
		}
		$this->redirect('/');
	}
}
