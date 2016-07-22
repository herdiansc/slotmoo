<?php
class PipesController extends AppController {
#    var $name = 'Pipes';
#    var $uses = 'Listing';
    
#    public $components = array('RequestHandler');

    public $unchecked = array('uploadify');
    
    function beforeFilter() {
        parent::beforeFilter();
        
        $this->Auth->allow('get_tops','get_top_topics','related');

        $this->Security->unlockedActions = array('uploadify','related');
    }
    
    function get_tops() {
        if($this->RequestHandler->isAjax()) {
            $tops = ClassRegistry::init('Listing')->top();
            if(empty($tops)) {
                $response = array(
                    'status'=>'empty',
                    'content'=>array()
                );            
            }else {
                $response = array(
                    'status'=>'success',
                    'content'=>$tops
                );
            }
#            debug($response);
            $this->set(compact('response'));
        }
    }
    
	public $allowedImages = array(3,2);
	public $image_extentions = array(
		3=>"png",
		2=>"jpg"
	);
    
#    function uploadify() {
#        // Define a destination
#        $targetFolder = WWW_ROOT.'uploads'.DS; // Relative to the root

#        $verifyToken = md5('unique_salt' . $_POST['timestamp']);

#        if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
#            $img_type = exif_imagetype($_FILES['Filedata']['tmp_name']);
#        
#            $filename = Security::hash($this->Session->read('Auth.User.id').time()).'.'.$this->image_extentions[$img_type];
#            
#	        $tempFile = $_FILES['Filedata']['tmp_name'];
#	        $targetFile = $targetFolder . $filename;
#	
#	        // Validate the file type
#	        $fileTypes = array('jpg','png'); // File extensions
#	        $fileParts = pathinfo($_FILES['Filedata']['name']);
#	
#	        if (in_array($fileParts['extension'],$fileTypes)) {
#		        $images = $this->Session->read('AdImages');
#		        if(sizeof($images) >= 4) {
#		            $response = array(
#		                'status'=>'error',
#		                'message'=>'image count reached'
#		            );		  
#	                echo json_encode($response);
#	                die();          
#		        }
##		        move_uploaded_file($tempFile,$targetFile);
##		        $images[ Inflector::slug($filename) ] = $filename;
##		        $this->Session->write('AdImages',$images);
##		        
##		        $response = array(
##		            'status'=>'success',
##		            'filename'=>$filename
##		        );
#		        if( $this->move_image($filename) ) {
#		            $response = array(
#		                'status'=>'success',
#		                'filename'=>$filename
#		            );		   
#		            $images[ Inflector::slug($filename) ] = $filename;
#		            $this->Session->write('AdImages',$images);     
#		        }else {
#		            $response = array(
#		                'status'=>'error'
#		            );		        
#		        }
#	        } else {
#		        $response = array(
#		            'status'=>'error'
#		        );
#	        }
#	        echo json_encode($response);
#	        die();
#        }
#    }
#    
#    function move_image($filename=null) {
#        // set up basic connection
#        $conn_id = ftp_connect(FTP_IMAGE_SERVER);

#        // login with username and password
#        $login_result = ftp_login($conn_id, FTP_IMAGE_USERNAME, FTP_IMAGE_PASSWORD);

#        // upload a file
#        if (ftp_put($conn_id, FTP_IMAGE_SERVER.'uploads/'.$filename, $filename, FTP_BINARY)) {
#            $res = true;
#        } else {
#            $res = false;
#        }

#        // close the connection
#        ftp_close($conn_id);
#        return $res;
#    }

#    function delete_image($filename=null) {
#        $response = array(
#            'status'=>'error'
#        );
#        if($this->RequestHandler->isAjax()) {
#            unlink(WWW_ROOT.'uploads'.DS.$filename);
#            $this->Session->delete('AdImages.'.Inflector::slug($filename));
#            if(isset($_GET['db'])) {
#                ClassRegistry::init('ImageListing')->deleteAll(array('ImageListing.filename'=>$filename,'ImageListing.listing_id'=>$_GET['listing_id']));
#            }
#            $response = array(
#                'status'=>'success'
#            );            
#        }
#        echo json_encode($response);
#        die();
#    }
#    
    function related() {
        $title = $this->request->data['title'];

        App::uses('Sanitize','Utility');
        $string = Sanitize::stripTags($title,'p','pre','blockquote','br','span','em','strong','img');
        $string = Sanitize::clean($string);
        $this->Listing = ClassRegistry::init('Listing');
#debug($this->params); 
#debug($string); 
#        $string = 'Honda Jazz Honda Jazz RS Honda Jazz Putih RS Bekas Masih Mulus';       
        $conds = array(
            'MATCH(title) AGAINST ("'.$string.'")'
        );
#        if( $this->Auth->user('id') ) {
#            $ids = $this->Note->User->Follower->getFollowingIds( $this->Auth->user('id') );
#            $ids[] = $this->Auth->user('id');
#            
#            $addCondsFollower = array(
#                '(Note.privacy_id = 2 AND Note.user_id IN ('.implode($ids,',').'))',
#                '(Note.privacy_id = 3 AND Note.user_id = '.$this->Auth->user('id').')'
#            );
#            $conds['OR'] = am($conds['OR'],$addCondsFollower);
#        }
        $this->Listing->virtualFields['_username'] = 'SELECT username FROM users WHERE users.id = Listing.user_id';
        $relateds = $this->Listing->find('all',array(
            'conditions'=>$conds,
            'fields'=>array(
                'Listing.id','Listing.title','Listing.description','Listing.user_id','Listing._username','Listing.slug','MATCH(title) AGAINST ("'.$string.'") AS score'
            ),
            'recursive'=>-1,
            'limit'=>10
        ));
//debug($relateds);
        unset($relateds[0]);
//$log = $this->Listing->getDataSource()->getLog(false, false);
//debug($log);
//debug($conds);
        $this->set(compact('relateds'));
    }
    
    function get_top_topics() {
        if($this->RequestHandler->isAjax()) {
#            $data = ClassRegistry::init('Keyword')->top();
#            $word_lists = $topic_lists = array();
#            $i=0;
#            foreach($data as $topic) {
#                $word_lists[ $topic['KeywordListing']['_keyword_slug'] ] = array(
#                    'text'=>$topic['KeywordListing']['_keyword_name'],
#                    'weight'=>$topic['KeywordListing']['_today_visit']+@$word_lists[ $topic['KeywordListing']['_keyword_slug'] ]['weight'],
#                    'link'=>Router::url('/').'keywords/view/'.$topic['KeywordListing']['_keyword_slug'],
#                    'html'=>array('title'=>__('Browse '.$topic['KeywordListing']['_keyword_name'],true))
#                );
#                if($i%3==0) $word_lists[ $topic['KeywordListing']['_keyword_slug'] ]['html']['class'] = 'vertical';
#                $i++;
#            }
#            foreach($word_lists as $word_list) {
#                $topic_lists[] = $word_list;
#            }
#            App::uses('Set','Utility');
#            $responses = Set::sort($topic_lists,'/weight','DESC');
#            $this->set(compact('responses'));

            $data = ClassRegistry::init('Keyword')->show_suggestion_list($this->Auth->user('id'));
            $word_lists = $topic_lists = array();
            $i=0;
            foreach($data as $topic) {
                $word_lists[ $topic['KeywordListing']['_keyword_slug'] ] = array(
                    'is_followed'=>$topic['KeywordListing']['is_followed'],
                    'keyword_id'=>$topic['KeywordListing']['keyword_id'],
                    'text'=>$topic['KeywordListing']['_keyword_name'],
                    'weight'=>$topic['KeywordListing']['_today_visit']+@$word_lists[ $topic['KeywordListing']['_keyword_slug'] ]['weight'],
                    'link'=>Router::url('/').'keywords/view/'.$topic['KeywordListing']['_keyword_slug'],
                    'html'=>array('title'=>__('Browse '.$topic['KeywordListing']['_keyword_name'],true))
                );
                if($i%3==0) $word_lists[ $topic['KeywordListing']['_keyword_slug'] ]['html']['class'] = 'vertical';
                $i++;
            }
            foreach($word_lists as $word_list) {
                $topic_lists[] = $word_list;
            }
            App::uses('Set','Utility');
            $responses = Set::sort($topic_lists,'/weight','DESC');
            $this->set(compact('responses'));
        }    
    }
    
    function show_keywords() {
        if($this->RequestHandler->isAjax()) {
            $data = ClassRegistry::init('Keyword')->show_suggestion_list($this->Auth->user('id'));
            $word_lists = $topic_lists = array();
            $i=0;
            foreach($data as $topic) {
                $word_lists[ $topic['KeywordListing']['_keyword_slug'] ] = array(
                    'is_followed'=>$topic['KeywordListing']['is_followed'],
                    'keyword_id'=>$topic['KeywordListing']['keyword_id'],
                    'text'=>$topic['KeywordListing']['_keyword_name'],
                    'weight'=>$topic['KeywordListing']['_today_visit']+@$word_lists[ $topic['KeywordListing']['_keyword_slug'] ]['weight'],
                    'link'=>Router::url('/').'keywords/view/'.$topic['KeywordListing']['_keyword_slug'],
                    'html'=>array('title'=>__('Browse '.$topic['KeywordListing']['_keyword_name'],true))
                );
                if($i%3==0) $word_lists[ $topic['KeywordListing']['_keyword_slug'] ]['html']['class'] = 'vertical';
                $i++;
            }
            foreach($word_lists as $word_list) {
                $topic_lists[] = $word_list;
            }
            App::uses('Set','Utility');
            $responses = Set::sort($topic_lists,'/weight','DESC');
            $this->set(compact('responses'));
            
            $this->layout = 'popup';
        }
    }
}
