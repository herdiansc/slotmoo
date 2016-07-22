<?php
App::uses('AppController', 'Controller');
/**
 * Comments Controller
 *
 * @property Comment $Comment
 */
class CommentsController extends AppController {

/**
 * index method
 *
 * @return void
 */
#	public function index() {
#		$this->Comment->recursive = 0;
#		$this->set('comments', $this->paginate());
#	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function view($id = null) {
#		if (!$this->Comment->exists($id)) {
#			throw new NotFoundException(__('Invalid comment'));
#		}
#		$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
#		$this->set('comment', $this->Comment->find('first', $options));
#	}

/**
 * add method
 *
 * @return void
 */
#	public function add() {
#		if ($this->request->is('post')) {
#			$this->request->data['Comment']['user_id'] = $this->Session->read('Auth.User.id');
#			$this->Comment->create();
#			if ($this->Comment->save($this->request->data)) {
#				$this->Session->setFlash('Komentar anda telah sukses tersimpan.');
#			} else {
#				$this->Session->setFlash('Maaf, komentar anda gagal tersimpan.');
#			}
#		}
#		$this->redirect($this->referer());
#	}
	
    function add() {
        if ($this->request->is('post')) {
		    App::uses('Sanitize','Utility');
#		    $this->request->data['Comment']['content'] = Sanitize::clean($this->request->data['Comment']['content']);
#		    
#		    $this->request->data['Comment']['content'] = nl2br($this->request->data['Comment']['content']);
#		    $this->request->data['Comment']['ip_address'] = $this->RequestHandler->getClientIP();
		    $this->request->data['Comment']['user_id'] = $this->Auth->user('id');
		    
		    $this->Comment->create();
			if ($this->Comment->save($this->request->data)) {
				$this->Session->setFlash('Komentar anda telah berhasil disimpan.');
			} else {
				$this->Session->setFlash('Maaf, komentar anda gagal tersimpan.');
			}
		    $this->redirect($this->referer());
        }
    }

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function edit($id = null) {
#		if (!$this->Comment->exists($id)) {
#			throw new NotFoundException(__('Invalid comment'));
#		}
#		if ($this->request->is('post') || $this->request->is('put')) {
#			if ($this->Comment->save($this->request->data)) {
#				$this->Session->setFlash(__('The comment has been saved'));
#				$this->redirect(array('action' => 'index'));
#			} else {
#				$this->Session->setFlash(__('The comment could not be saved. Please, try again.'));
#			}
#		} else {
#			$options = array('conditions' => array('Comment.' . $this->Comment->primaryKey => $id));
#			$this->request->data = $this->Comment->find('first', $options);
#		}
#		$listings = $this->Comment->Listing->find('list');
#		$users = $this->Comment->User->find('list');
#		$this->set(compact('listings', 'users'));
#	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function delete($id = null) {
#		$this->Comment->id = $id;
#		if (!$this->Comment->exists()) {
#			throw new NotFoundException(__('Invalid comment'));
#		}
#		$this->request->onlyAllow('post', 'delete');
#		if ($this->Comment->delete()) {
#			$this->Session->setFlash(__('Comment deleted'));
#			$this->redirect(array('action' => 'index'));
#		}
#		$this->Session->setFlash(__('Comment was not deleted'));
#		$this->redirect(array('action' => 'index'));
#	}
	
	function delete($id=null) {
	    if($id != null) {
	        $conds = array('Comment.id'=>$id,'Comment.user_id'=>$this->Auth->user('id'));
	        if($this->Comment->deleteAll($conds)) {
	            $this->Session->setFlash('Komentar telah berhasil dihapus');
	        }else {
                $this->Session->setFlash('Komentar gagal terhapus','default',array('class'=>'flash-error'));
	        }
	    }
	    $this->redirect($this->referer());
	}
}
