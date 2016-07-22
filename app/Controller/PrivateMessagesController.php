<?php
App::uses('AppController', 'Controller');
/**
 * PrivateMessages Controller
 *
 * @property PrivateMessage $PrivateMessage
 */
class PrivateMessagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
#	public function index() {
#		$this->PrivateMessage->recursive = 0;
#	    $this->paginate = array(
#	        'conditions'=>array(
#	            'PrivateMessage.to_id'=>$this->Auth->user('id')
#	        )
#	    );
#		$this->set('privateMessages', $this->paginate());
#	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function view($id = null) {
#		if (!$this->PrivateMessage->exists($id)) {
#			throw new NotFoundException(__('Invalid private message'));
#		}
#		$options = array('conditions' => array('PrivateMessage.' . $this->PrivateMessage->primaryKey => $id));
#		$this->set('privateMessage', $this->PrivateMessage->find('first', $options));
#	}

/**
 * add method
 *
 * @return void
 */
#	public function add($user_id=null,$listing_id=null) {
#		if ($this->request->is('post') && $this->RequestHandler->isAjax() && $user_id != null) {
#		    $this->request->data['PrivateMessage']['from_id'] = $this->Auth->user('id');
#			$this->PrivateMessage->create();
#			if ($this->PrivateMessage->save($this->request->data)) {
#			    $response = array('status'=>'success','message'=>'Pesan anda telah sukses terkirim');
#			} else {
#				$response = array('status'=>'success','message'=>'Pesan anda telah sukses terkirim');
#			}
#			echo json_encode($response);
#			die();
#		}
#	    $this->request->data['PrivateMessage']['to_id'] = $user_id;
#	
#	    $this->layout = 'popup';
#	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function edit($id = null) {
#		if (!$this->PrivateMessage->exists($id)) {
#			throw new NotFoundException(__('Invalid private message'));
#		}
#		if ($this->request->is('post') || $this->request->is('put')) {
#			if ($this->PrivateMessage->save($this->request->data)) {
#				$this->Session->setFlash(__('The private message has been saved'));
#				$this->redirect(array('action' => 'index'));
#			} else {
#				$this->Session->setFlash(__('The private message could not be saved. Please, try again.'));
#			}
#		} else {
#			$options = array('conditions' => array('PrivateMessage.' . $this->PrivateMessage->primaryKey => $id));
#			$this->request->data = $this->PrivateMessage->find('first', $options);
#		}
#		$froms = $this->PrivateMessage->From->find('list');
#		$tos = $this->PrivateMessage->To->find('list');
#		$this->set(compact('froms', 'tos'));
#	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function delete($id = null) {
#		$this->PrivateMessage->id = $id;
#		if (!$this->PrivateMessage->exists()) {
#			throw new NotFoundException(__('Invalid private message'));
#		}
#		$this->request->onlyAllow('post', 'delete');
#		if ($this->PrivateMessage->delete()) {
#			$this->Session->setFlash(__('Private message deleted'));
#			$this->redirect(array('action' => 'index'));
#		}
#		$this->Session->setFlash(__('Private message was not deleted'));
#		$this->redirect(array('action' => 'index'));
#	}
}
