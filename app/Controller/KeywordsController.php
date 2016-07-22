<?php
App::uses('AppController', 'Controller');
/**
 * Keywords Controller
 *
 * @property Keyword $Keyword
 */
class KeywordsController extends AppController {

    public $components = array('RequestHandler');

/**
 * index method
 *
 * @return void
 */
#	public function index() {
#		$this->Keyword->recursive = 0;
#		$this->set('keywords', $this->paginate());
#	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function view($id = null) {
#		if (!$this->Keyword->exists($id)) {
#			throw new NotFoundException(__('Invalid keyword'));
#		}
#		$options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
#		$this->set('keyword', $this->Keyword->find('first', $options));
#	}

/**
 * add method
 *
 * @return void
 */
#	public function add() {
#		if ($this->request->is('post')) {
#			$this->Keyword->create();
#			if ($this->Keyword->save($this->request->data)) {
#				$this->Session->setFlash(__('The keyword has been saved'));
#				$this->redirect(array('action' => 'index'));
#			} else {
#				$this->Session->setFlash(__('The keyword could not be saved. Please, try again.'));
#			}
#		}
#	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function edit($id = null) {
#		if (!$this->Keyword->exists($id)) {
#			throw new NotFoundException(__('Invalid keyword'));
#		}
#		if ($this->request->is('post') || $this->request->is('put')) {
#			if ($this->Keyword->save($this->request->data)) {
#				$this->Session->setFlash(__('The keyword has been saved'));
#				$this->redirect(array('action' => 'index'));
#			} else {
#				$this->Session->setFlash(__('The keyword could not be saved. Please, try again.'));
#			}
#		} else {
#			$options = array('conditions' => array('Keyword.' . $this->Keyword->primaryKey => $id));
#			$this->request->data = $this->Keyword->find('first', $options);
#		}
#	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function delete($id = null) {
#		$this->Keyword->id = $id;
#		if (!$this->Keyword->exists()) {
#			throw new NotFoundException(__('Invalid keyword'));
#		}
#		$this->request->onlyAllow('post', 'delete');
#		if ($this->Keyword->delete()) {
#			$this->Session->setFlash(__('Keyword deleted'));
#			$this->redirect(array('action' => 'index'));
#		}
#		$this->Session->setFlash(__('Keyword was not deleted'));
#		$this->redirect(array('action' => 'index'));
#	}
	
    function get_suggestions() {
        if($this->RequestHandler->isAjax()) {
            echo $this->Keyword->getSuggestions($_GET['term']);
        }
        die();
    }
    
	public function delete_keyword_listing($id = null,$listing_id=null) {
		$response = array('status'=>'error');
		if($this->RequestHandler->isAjax()) {
		    if ($this->Keyword->KeywordListing->deleteAll(array('KeywordListing.id'=>$id,'KeywordListing.listing_id'=>$listing_id))) {
		        $response = array('status'=>'success');
		    }
		}
		echo json_encode($response);
		die();
	}
	
	
    function view($slug=null) {
        if($slug!=null) {
            $title_for_layout = $KeywordName = $this->Keyword->field('name',array('Keyword.slug'=>$slug));
            
            if($KeywordName == null) {
                $this->Session->setFlash('Kata kunci tidak ditemukan','default',array('class'=>'flash-error'));
                $this->redirect('/');
            }
            
            $sortingParams = $this->getSortingParams();
            $this->set('get',$sortingParams['get']);
            
            $this->Keyword->KeywordListing->Listing->virtualFields['_username'] = 'SELECT users.username FROM users WHERE users.id = Listing.user_id';
            $this->Keyword->KeywordListing->Listing->virtualFields['_photo_profile'] = 'SELECT users.photo_profile FROM users WHERE users.id = Listing.user_id';
            $this->Keyword->KeywordListing->Listing->virtualFields['_display_name'] = 'SELECT group_concat(value separator " ") FROM user_details where field in("User.first_name","User.last_name") and user_id = Listing.user_id';
            
            $conds = array(
                'Keyword.slug'=>$slug
            );
            
	        $this->paginate = array(
	            'limit'=>20,
                'conditions'=>$conds,
                'order'=>$sortingParams['o']
            );
            $listings = $this->paginate('KeywordListing');
            $this->set(compact('listings','KeywordName','title_for_layout'));
        }else {
            $this->redirect('/');
        }
    }
    
    
    function follow($id=null) {
        $response = array('status'=>'error');
        if($this->RequestHandler->isAjax()){
            if($this->Keyword->Follow->follow_keyword($id,$this->Auth->user('id'))) {
                $response = array('status'=>'success');
            }
        }
        echo json_encode($response);
        die();
    }
    
    function unfollow($id=null) {
        $response = array('status'=>'error');
        if($this->RequestHandler->isAjax()){
            if($this->Keyword->Follow->deleteAll(array('Follow.keyword_id'=>$id,'Follow.user_id'=>$this->Auth->user('id')))) {
                $response = array('status'=>'success');
            }
        }
        echo json_encode($response);
        die();
    }
}
