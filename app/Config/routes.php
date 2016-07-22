<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
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
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
    Router::parseExtensions('rss','xml'); 
	Router::connect('/', Configure::read('Route.default'));
	Router::connect('/sitemap', array('controller' => 'sitemaps', 'action' => 'index')); 
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));
	
	
	Router::connect('/:username/ads/:id/:slug', array('member'=>false,'admin'=>false,'controller'=>'listings','action'=>'view'), array('pass' => array('username','id','slug')));
	
	Router::connect('/:username', array('member'=>false,'admin'=>false,'plugin'=>'users','controller'=>'users','action'=>'view'), array('pass' => array('username')));
	
	Router::connect('/:username/profile', array('member'=>false,'admin'=>false,'controller'=>'users','action'=>'profile'), array('pass' => array('username')));
	Router::connect('/:username/photo_profile', array('member'=>false,'admin'=>false,'controller'=>'users','action'=>'photo_profile'), array('pass' => array('username')));
	Router::connect('/:username/edit', array('member'=>false,'admin'=>false,'controller'=>'users','action'=>'edit'), array('pass' => array('username')));
	Router::connect('/:username/change_password', array('member'=>false,'admin'=>false,'controller'=>'users','action'=>'change_password'), array('pass' => array('username')));

	Router::connect('/ads/new', array('member'=>false,'admin'=>false,'controller'=>'listings','action'=>'add'));
	Router::connect('/ads/browse', array('member'=>false,'admin'=>false,'controller'=>'listings','action'=>'browse'));
	
#	Router::connect('/users/register', array( 'controller' => 'users','action'=>'add'));
	Router::connect('/users/after', array('plugin'=>false,'controller' => 'users','action'=>'after'));
	Router::connect('/contact/us', array('plugin'=>false,'controller' => 'site_messages','action'=>'add'));
#	Router::connect('/users/login', array('plugin' => 'users', 'controller' => 'users','action'=>'login'));

/**
 * Load all plugin routes. See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
