<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
App::uses('Inflector', 'Core');
App::import('Vendor', 'facebook/src/facebook');
/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	public $helpers = array(
		'Html',
		'Form',
		'Session',
		'Time',
		//'Gravatar.Gravatar',
		'Text',
		'ImageThumbnail');
	public $components = array(
		'Auth',
		'Session',
		'Cookie',
		'Paginator',
		'Security',
		'RequestHandler',
		//'DebugKit.Toolbar'
	);
    var $uses = array('Users.User');
    var $facebook;
    var $__fbApiKey = '521271821223303';
    var $__fbSecret = '1f83b213c1cf35d64ff9c98a1d1df6bb';
    
    function beforeFilter() {
        $GLOBALS['facebook_config']['debug'] = NULL;
        $this->facebook = new Facebook(array(
            'appId'  => $this->__fbApiKey,
            'secret' => $this->__fbSecret,
            'cookie' => true
        ));
        
        // Authentication settings
        $this->Auth->allow('reset', 'verify', 'logout', 'view', 'reset_password', 'login','display');
        $this->Auth->fields = array('username' => 'email', 'password' => 'password');
        
        if($this->Auth->user('id') && $this->request->params['action'] == 'login'){
            $this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user('username')));
            $this->redirect(array('admin'=>false,'plugin' => false, 'controller' => 'listings', 'action' => 'index'));
        }
        
        $this->__checkFBStatus();

        //send all user info to the view
        $this->set('user', $this->Auth->user('id'));

        if(!$this->RequestHandler->isAjax()) $this->setSiteMeta();
        $this->setLayout();
    }

    private function __checkFBStatus(){
        $fbid = $this->facebook->getUser();
        if(!$this->Auth->user('id') && $fbid ):
			$user_profile = $this->facebook->api('/me');
            $user_record = $this->User->find('first', array(
					'conditions' => array('User.email' => $user_profile['email'])
                ));
			if($user_record['User']['fbid'] == null) {
				$user_save_fb_id['User']['id'] = $user_record['User']['id'];
				$user_save_fb_id['User']['fbid'] = $fbid;

                $this->User->updateAll(
                    array('User.fbid' => '"'.$fbid.'"'),
                    array('User.id' => $user_record['User']['id'])
                );
			}
            if(empty($user_record)):
                //$user_profile = $this->facebook->api('/me');
                $user_record['username'] = Inflector::slug($user_profile['first_name']);
				//Need improvement, make sure that slug is unique.
                //$user_record['slug'] = Inflector::slug($user_profile['first_name']);
                $user_record['tos'] = 1;
                $user_record['active'] = 1;
                $user_record['role'] = 'registered';
                $user_record['email'] = $user_profile['email'];
                $user_record['email_verified'] = 1;
                $user_record['fbid'] = $fbid;
                $user_record['fbpassword'] = $this->__randomString();
                $user_record['password'] = $this->Auth->password($user_record['fbpassword']);
                
                $this->User->create();
                $user_record = $this->User->save($user_record,false);
                
                $user_record = $user_record['User'];
            else:
                $user_record = $user_record['User'];
            endif;

			if ($this->Auth->login($user_record)) {
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('last_login', date('Y-m-d H:i:s'));

				$this->Session->setFlash(sprintf(__d('users', '%s you have successfully logged in'), $this->Auth->user('username')));
			} else {
				$this->Auth->flash(__d('users', 'Invalid e-mail / password combination.  Please try again'));
			}
        endif;            
    }

    private function __randomString($minlength = 20, $maxlength = 20, $useupper = true, $usespecial = false, $usenumbers = true){
        $charset = "abcdefghijklmnopqrstuvwxyz";
        if ($useupper) $charset .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        if ($usenumbers) $charset .= "0123456789";
        if ($usespecial) $charset .= "~@#$%^*()_+-={}|][";
        if ($minlength > $maxlength) $length = mt_rand ($maxlength, $minlength);
        else $length = mt_rand ($minlength, $maxlength);
        $key = '';
        for ($i=0; $i<$length; $i++){
            $key .= $charset[(mt_rand(0,(strlen($charset)-1)))];
        }
        return $key;
    }
    
    function beforeRender() {
        //debug($this->params);
        if( ($this->here == '/' || $this->params['action'] == 'login') && !$this->Auth->user('id') ) {
            if(!$this->facebook->getUser()) {
                $params = array(
                    'scope' => 'read_stream,publish_stream,email,offline_access',
                    'redirect_uri' => Router::url('/',true).'pages/fb_callback',
                    'display'=>'popup'
                );
                $this->set('fb_login_url',$this->facebook->getLoginUrl($params));
                $this->set('fbapikey',$this->__fbApiKey);
            }
        }
    }   
    
    function setLayout() {
        if($this->request->params['action'] == 'login') {
            $this->layout = 'login';
        }else if($this->RequestHandler->isAjax()){
            if( $this->layout != 'popup' ){
                $this->layout = 'ajax';
            }
        }else if($this->here == '/' && !$this->Session->check('Auth.User.id')) {
            $this->layout = 'default';
        }else if($this->controller == 'Listings' && $this->action == 'browse') {
            $this->layout = 'browse';
        }else {
            $this->layout = 'member_area';
        }
    }
    
    function setSiteMeta($metas = array()) {
        $defaults = array(
            'title'=>Inflector::humanize($this->params->action),
            'description'=>SITE_DESC,
            'keywords'=>SITE_KEYWORDS
        );
        $metas = array_merge($defaults,$metas);
        
        $title_for_layout = $metas['title'];
        $description_for_layout = $metas['description'];
        $keywords_for_layout = $metas['keywords'];
        
	    $this->set(compact('title_for_layout','description_for_layout','keywords_for_layout'));
    }
    
    function getSortingParams() {
        if(sizeof(@$this->params->query['o']) > 0) {
            $get = 'o='.$this->params->query['o'].'&dir='.$this->params->query['dir'];
            $o = 'Listing.'.$this->params->query['o'].' '.$this->params->query['dir'];
        }else {
            $o = 'Listing.created DESC';
            $get = null;
        }
        return array('o'=>$o,'get'=>$get);
    }
    
     
}
