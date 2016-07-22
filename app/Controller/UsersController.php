<?php
App::uses('AppController', 'Controller');
/**
 * Categories Controller
 *
 * @property Category $Category
 */
class UsersController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add','after');
    }
    public function profile() {
		$user['info'] = $this->User->findSummary($this->Auth->user('id'));
		$this->set(compact('user'));
    }
    
	public function after() {
        $this->Session->write('Auth.redirect',$this->params['url']['redir']);
        $this->redirect('/users/'.$this->params['url']['action']);
	}
    
/**
 * Edit
 *
 * @param string $id User ID
 * @return void
 */
	public function edit() {
	    $this->loadModel('Users.User');
		if (!empty($this->request->data)) {
			if ($this->User->UserDetail->saveSection($this->Auth->user('id'), $this->request->data, 'User')) {
				$this->Session->setFlash(__d('users', 'Profile saved.'));
			} else {
				$this->Session->setFlash(__d('users', 'Could not save your profile.'));
			}
		} else {
			$data = $this->User->UserDetail->getSection($this->Auth->user('id'), 'User');
			if (!isset($data['User'])){
				$data['User'] = array();
			}
			$this->request->data['UserDetail'] = $data['User'];
		}
		$user['info'] = $this->User->findSummary($this->Auth->user('id'));
		$this->set(compact('user'));
	}
	
/**
 * Allows the user to enter a new password, it needs to be confirmed by entering the old password
 *
 * @return void
 */
	public function change_password() {
	    $this->loadModel('Users.User');
		if ($this->request->is('post')) {
			$this->request->data[$this->modelClass]['id'] = $this->Auth->user('id');
			if ($this->User->changePassword($this->request->data)) {
				$this->Session->setFlash(__d('users', 'Password changed.'));
				$this->redirect('/'.$this->Auth->user('username').'/profile');
			}
		}
		$user['info'] = $this->User->findSummary($this->Auth->user('id'));
		$this->set(compact('user'));
	}
	
/**
 * User register action
 *
 * @return void
 */
#	public function add() {
#	    $this->loadModel('Users.User');
#		if ($this->Auth->user()) {
#			$this->Session->setFlash(__d('users', 'You are already registered and logged in!'));
#			$this->redirect('/');
#		}
#        if($this->referer() != '/') {
#		if (!empty($this->request->data)) {
#			$user = $this->User->register($this->request->data);
#			if ($user !== false) {
#				//$this->_sendVerificationEmail($this->User->data);
#				//$this->Session->setFlash(__d('users', 'Your account has been created. You should receive an e-mail shortly to authenticate your account. Once validated you will be able to login.'));
#				$this->Session->setFlash(__d('users', 'Registration successful. Now you can login and use your account.'));
#				$this->redirect(array('action' => 'login'));
#			} else {
#				unset($this->request->data[$this->modelClass]['password']);
#				unset($this->request->data[$this->modelClass]['temppassword']);
#				$this->Session->setFlash(__d('users', 'Your account could not be created. Please, try again.'), 'default', array('class' => 'message warning'));
#			}
#		}
#	}
	
	function photo_profile() {
	    if(!empty($this->request->data)) {
	        $allowedTypes = array('image/png','image/jpeg','image/jpg');
            if(!in_array($this->request->data['User']['photo_profile']['type'],$allowedTypes)) {
                $this->Session->setFlash('Silahkan dunakan gambar jpeg, jpg, atau png','default',array('class'=>'flash-error'));
                $this->redirect($this->here);
            }
	        $name = Security::hash($this->request->data['User']['photo_profile'].$this->Auth->user('username'));
            $fileName = $name.'.jpg';
            
            $destDir = WWW_ROOT.'files'.DS.'photo_profiles'.DS.'customed'.DS;
            


            $dest = $destDir.$fileName;
            
            move_uploaded_file($this->request->data['User']['photo_profile']['tmp_name'],$dest);
            $this->_imgScale($dest,$destDir,$name);
            
            
            $this->request->data['User']['photo_profile'] = $fileName;
            $this->request->data['User']['image_server'] = CDN;
            
            
            $this->User->id = $this->Auth->user('id');
            if($this->User->save($this->request->data)) {
                $this->Session->setFlash('Upload sukses, silahkan refresh(CTRL+R) halamannya.');
            }else {
                $this->Session->setFlash('Photo profile gagal dirubah, silahkan coba lagi.','default',array('class'=>'flash-error'));
            }
	    }
#	    $user = $this->User->getAnotherUserProfile($this->Auth->user('id'),$this->Auth->user('id'));
#	    $this->set(compact('user'));
		$user['info'] = $this->User->findSummary($this->Auth->user('id'));
		$this->set(compact('user'));
	}
	
    function _imgScale($source=null,$destDir=null,$filename=null) {
        list($width, $height, $type, $attr) = getimagesize($source);

        if($width <= 70 || $height <= 70) return null;

        if($width > $height) {
            $w = $h = $height;
        }elseif($width < $height) {
            $w = $h = $width;
        }else {
            $w = $h = $width;
        }

        if($type == 2){
            $largeimage = imagecreatefromjpeg($source);
        }elseif($type == 3) {
            $largeimage = imagecreatefrompng($source);
        }
        $thumb_70 = imagecreatetruecolor(70, 70);
        
        imagecopyresampled($thumb_70, $largeimage, 0, 0, 0, 0,
        70, 70, $w, $h);
        
        imagejpeg($thumb_70, $source);
        
        imagedestroy($largeimage);
        imagedestroy($thumb_70);
    }
}
