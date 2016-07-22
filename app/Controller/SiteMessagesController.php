<?php
App::uses('AppController', 'Controller');
/**
 * SiteMessages Controller
 *
 * @property SiteMessage $SiteMessage
 */
class SiteMessagesController extends AppController {

/**
 * index method
 *
 * @return void
 */
#	public function index() {
#		$this->SiteMessage->recursive = 0;
#		$this->set('SiteMessages', $this->paginate());
#	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function view($id = null) {
#		if (!$this->SiteMessage->exists($id)) {
#			throw new NotFoundException(__('Invalid SiteMessage'));
#		}
#		$options = array('conditions' => array('SiteMessage.' . $this->SiteMessage->primaryKey => $id));
#		$this->set('SiteMessage', $this->SiteMessage->find('first', $options));
#	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
		    $this->request->data['SiteMessage']['user_id'] = $this->Auth->user('id');
		    $this->request->data['SiteMessage']['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
		    $this->request->data['SiteMessage']['ip_address'] = $this->RequestHandler->getClientIP();
			$this->SiteMessage->create();
			if ($this->SiteMessage->save($this->request->data)) {
				$this->Session->setFlash('Teimakasih. Pesan anda sudah terkirim');
				$this->redirect('/');
			} else {
				$this->Session->setFlash('Pesan anda gagal terkirim.');
			}
		}
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function edit($id = null) {
#		if (!$this->SiteMessage->exists($id)) {
#			throw new NotFoundException(__('Invalid SiteMessage'));
#		}
#		if ($this->request->is('post') || $this->request->is('put')) {
#			if ($this->SiteMessage->save($this->request->data)) {
#				$this->Session->setFlash(__('The SiteMessage has been saved'));
#				$this->redirect(array('action' => 'index'));
#			} else {
#				$this->Session->setFlash(__('The SiteMessage could not be saved. Please, try again.'));
#			}
#		} else {
#			$options = array('conditions' => array('SiteMessage.' . $this->SiteMessage->primaryKey => $id));
#			$this->request->data = $this->SiteMessage->find('first', $options);
#		}
#		$users = $this->SiteMessage->User->find('list');
#		$this->set(compact('users'));
#	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
#	public function delete($id = null) {
#		$this->SiteMessage->id = $id;
#		if (!$this->SiteMessage->exists()) {
#			throw new NotFoundException(__('Invalid SiteMessage'));
#		}
#		$this->request->onlyAllow('post', 'delete');
#		if ($this->SiteMessage->delete()) {
#			$this->Session->setFlash(__('SiteMessage deleted'));
#			$this->redirect(array('action' => 'index'));
#		}
#		$this->Session->setFlash(__('SiteMessage was not deleted'));
#		$this->redirect(array('action' => 'index'));
#	}
}
