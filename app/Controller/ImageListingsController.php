<?php
App::uses('AppController', 'Controller');
/**
 * ImageListings Controller
 *
 * @property ImageListing $ImageListing
 */
class ImageListingsController extends AppController {

    function beforeFilter() {
        parent::beforeFilter();

        $this->Security->unlockedActions = array('uploadify');
        $this->Auth->allow('uploadify');
    }

/**
 * index method
 *
 * @return void
 */
#	public function index() {
#		$this->ImageListing->recursive = 0;
#		$this->set('imageListings', $this->paginate());
#	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function view($id = null) {
#		if (!$this->ImageListing->exists($id)) {
#			throw new NotFoundException(__('Invalid image listing'));
#		}
#		$options = array('conditions' => array('ImageListing.' . $this->ImageListing->primaryKey => $id));
#		$this->set('imageListing', $this->ImageListing->find('first', $options));
#	}

/**
 * add method
 *
 * @return void
 */
#	public function add() {
#		if ($this->request->is('post')) {
#			$this->ImageListing->create();
#			if ($this->ImageListing->save($this->request->data)) {
#				$this->Session->setFlash(__('The image listing has been saved'));
#				$this->redirect(array('action' => 'index'));
#			} else {
#				$this->Session->setFlash(__('The image listing could not be saved. Please, try again.'));
#			}
#		}
#		$listings = $this->ImageListing->Listing->find('list');
#		$this->set(compact('listings'));
#	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function edit($id = null) {
#		if (!$this->ImageListing->exists($id)) {
#			throw new NotFoundException(__('Invalid image listing'));
#		}
#		if ($this->request->is('post') || $this->request->is('put')) {
#			if ($this->ImageListing->save($this->request->data)) {
#				$this->Session->setFlash(__('The image listing has been saved'));
#				$this->redirect(array('action' => 'index'));
#			} else {
#				$this->Session->setFlash(__('The image listing could not be saved. Please, try again.'));
#			}
#		} else {
#			$options = array('conditions' => array('ImageListing.' . $this->ImageListing->primaryKey => $id));
#			$this->request->data = $this->ImageListing->find('first', $options);
#		}
#		$listings = $this->ImageListing->Listing->find('list');
#		$this->set(compact('listings'));
#	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function delete($id = null) {
#		$this->ImageListing->id = $id;
#		if (!$this->ImageListing->exists()) {
#			throw new NotFoundException(__('Invalid image listing'));
#		}
#		$this->request->onlyAllow('post', 'delete');
#		if ($this->ImageListing->delete()) {
#			$this->Session->setFlash(__('Image listing deleted'));
#			$this->redirect(array('action' => 'index'));
#		}
#		$this->Session->setFlash(__('Image listing was not deleted'));
#		$this->redirect(array('action' => 'index'));
#	}
	public $allowedImages = array(3,2);
	public $image_extentions = array(
		3=>"png",
		2=>"jpg"
	);
	public $allowedMimeTypes = array(
		"image/jpeg",
		"image/jpg"
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
#		        if( $this->move_image($tempFile,$filename) ) {
#		            $response = array(
#		                'status'=>'success',
#		                'filename'=>$filename
#		            );		   
#		            $images[ Inflector::slug($filename) ] = array(
#		                'filename'=>$filename,
#		                'CDN'=>CDN
#		            );
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
#    function move_image($tempFile=null,$filename=null) {
#        $conn_id = $this->connect_to_ftp();
#        $res = ftp_put($conn_id, $filename, $tempFile, FTP_BINARY) ? true : false;
#        ftp_close($conn_id);
#        return $res;    
#    }
#    
#    function remove_image($filename=null) {
#        $conn_id = $this->connect_to_ftp();
#        $res = ftp_delete($conn_id, $filename) ? true : false;
#        ftp_close($conn_id);
#        return $res;    
#    }
#    
#    function connect_to_ftp() {
#        $conn_id = ftp_connect(FTP_IMAGE_SERVER);
#        $login_result = ftp_login($conn_id, FTP_IMAGE_USERNAME, FTP_IMAGE_PASSWORD);
#        ftp_chdir($conn_id, '/public_html/uploads/');
#        return $conn_id;
#    }
#    
#    function delete_image($filename=null) {
#        $response = array(
#            'status'=>'error'
#        );
#        if($this->RequestHandler->isAjax()) {
#            if( $this->remove_image($filename) ) {
#                $this->Session->delete('AdImages.'.Inflector::slug($filename));
#                if(isset($_GET['db'])) {
#                    ClassRegistry::init('ImageListing')->deleteAll(array('ImageListing.filename'=>$filename,'ImageListing.listing_id'=>$_GET['listing_id']));
#                }
#                $response = array(
#                    'status'=>'success'
#                );
#            }
#        }
#        echo json_encode($response);
#        die();
#    }

    function uploadify() {
        // Define a destination
        $targetFolder = WWW_ROOT.'uploads'.DS; // Relative to the root

#        $verifyToken = md5('unique_salt' . $_POST['timestamp']);
//debug($_FILES);
        if (!empty($_FILES)) {
            $filesize = filesize($_FILES['listing_image']['tmp_name']);
            list($width,$height) = getimagesize($_FILES['listing_image']['tmp_name']);
	        if (
	            in_array($_FILES['listing_image']['type'],$this->allowedMimeTypes) && 
	            //$filesize < 100000 && 
	            $width > 100 && $height > 100
	            ) {
	            
                $img_type = exif_imagetype($_FILES['listing_image']['tmp_name']);
            
                $filename = Security::hash($this->Session->read('Auth.User.id').time()).'.'.$this->image_extentions[$img_type];
                
	            $tempFile = $_FILES['listing_image']['tmp_name'];
	            $targetFile = $targetFolder . $filename;
	        

		        $images = $this->Session->read('AdImages');
		        if(sizeof($images) >= 4) {
		            $response = array(
		                'status'=>'error',
		                'message'=>'image count reached'
		            );		  
	                echo json_encode($response);
	                die();          
		        }
		        
                include(APP.'Vendor'.DS.'resize.class.php');
                $resizeObj = new resize($tempFile);
                
                if($width > 500 || $height > 500) {
                    $resizeObj->resizeImage(500, 500, 'crop');
                }else {
                    $resizeObj->resizeImage($width, $height, 'crop');
#                    move_uploaded_file($tempFile,$targetFile);
                }
                $resizeObj->saveImage($targetFile, 70);
                
                
	            $images[ Inflector::slug($filename) ] = array(
	                'filename'=>$filename,
	                'CDN'=>CDN
	            );
		        $this->Session->write('AdImages',$images);
		        
		        $response = array(
		            'status'=>'success',
		            'filename'=>$filename,
		            'message'=>'Upload gambar behasil'
		        );
	        } else {
		        $response = array(
		            'status'=>'error',
		            'message'=>'Upload gambar gagal'
		        );
	        }
	        echo json_encode($response);
	        die();
        }
	    die();
    }

    function delete_image($filename=null) {
        $response = array(
            'status'=>'error',
            'message'=>'Hapus gambar gagal'
        );
        if($this->RequestHandler->isAjax()) {
            $exploded_filename = explode('.',$filename);
            array_map( "unlink", glob(WWW_ROOT.'uploads'.DS.$exploded_filename[0].'*') );
#            
#            $files = glob(WWW_ROOT.'uploads'.DS.'/'.$filename.'_*.');
#            debug($files);die();
#            array_walk($files,'unlink');
#            unlink(WWW_ROOT.'uploads'.DS.$filename);
            $this->Session->delete('AdImages.'.Inflector::slug($filename));
            if(isset($_GET['db'])) {
                ClassRegistry::init('ImageListing')->deleteAll(array('ImageListing.filename'=>$filename,'ImageListing.listing_id'=>$_GET['listing_id']));
            }
            $response = array(
                'status'=>'success',
                'message'=>'Hapus gambar berhasil'
            );            
        }
        echo json_encode($response);
        die();
    }
}
