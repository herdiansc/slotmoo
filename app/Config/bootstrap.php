<?php
/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
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
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

// Setup a 'default' cache configuration for use in the application.
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models', '/next/path/to/models'),
 *     'Model/Behavior'            => array('/path/to/behaviors', '/next/path/to/behaviors'),
 *     'Model/Datasource'          => array('/path/to/datasources', '/next/path/to/datasources'),
 *     'Model/Datasource/Database' => array('/path/to/databases', '/next/path/to/database'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions', '/next/path/to/sessions'),
 *     'Controller'                => array('/path/to/controllers', '/next/path/to/controllers'),
 *     'Controller/Component'      => array('/path/to/components', '/next/path/to/components'),
 *     'Controller/Component/Auth' => array('/path/to/auths', '/next/path/to/auths'),
 *     'Controller/Component/Acl'  => array('/path/to/acls', '/next/path/to/acls'),
 *     'View'                      => array('/path/to/views', '/next/path/to/views'),
 *     'View/Helper'               => array('/path/to/helpers', '/next/path/to/helpers'),
 *     'Console'                   => array('/path/to/consoles', '/next/path/to/consoles'),
 *     'Console/Command'           => array('/path/to/commands', '/next/path/to/commands'),
 *     'Console/Command/Task'      => array('/path/to/tasks', '/next/path/to/tasks'),
 *     'Lib'                       => array('/path/to/libs', '/next/path/to/libs'),
 *     'Locale'                    => array('/path/to/locales', '/next/path/to/locales'),
 *     'Vendor'                    => array('/path/to/vendors', '/next/path/to/vendors'),
 *     'Plugin'                    => array('/path/to/plugins', '/next/path/to/plugins'),
 * ));
 *
 */

/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */

/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
 //CakePlugin::load('Facebook');
 CakePlugin::load('Users', array('routes' => true));
 CakePlugin::load('Search');
 CakePlugin::load('Utils');
 //CakePlugin::load('DebugKit');
 CakePlugin::load('Recaptcha');
Configure::write('Recaptcha.publicKey', '6LcqtuQSAAAAAFCEusrwdrxLFzqw0LXZlugkv3cR');
Configure::write('Recaptcha.privateKey', '6LcqtuQSAAAAAK2KC3eOQN8bcnEfunIUCWJCoyjn');

/**
 * You can attach event listeners to the request lifecycle as Dispatcher Filter . By Default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 *		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 *		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 *		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
	'AssetDispatcher',
	'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
	'engine' => 'FileLog',
	'types' => array('notice', 'info', 'debug'),
	'file' => 'debug',
));
CakeLog::config('error', array(
	'engine' => 'FileLog',
	'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
	'file' => 'error',
));

 define('SITE_NAME','Slot Moo');
 define('SITE_SLOGAN','Sosial media periklanan yang mudah dan cepat');
 define('SITE_DESC',SITE_NAME.' adalah sebuah sosial media periklanan. Anda bisa memposting iklan secara gratis atau sebagai pembeli anda bisa mengikuti kata kunci agar mudah mencari barang yang dibutuhkan.');
 define('SITE_KEYWORDS','Advertisement, online ads, internet ads, publishing, text posting, ads posting, microblogging, social blogging, social media, social networking');
 
 define('NO_REPLY_MAIL','Slot Moo <no-reply@slotmoo.com>');

 define('IMAGES_ALLOWED', 4);  
 
 //Image Server
 define('FTP_IMAGE_SERVER', 'server38.000webhost.com');
 define('FTP_IMAGE_USERNAME', 'a4967279');
 define('FTP_IMAGE_PASSWORD', 'adalah123');  
 
/*
 *
 * Ini adalah bagian yang dirubah ketika deployment
 *
**/
//Upload isi webroot ke 000webhost.com dan sesuaikan ASET_CDN supaya nembak ke sana 
 define('ASSET_CDN', 'http://cdn.slotmoo.local/'); 
//Buat sub domain dan arahkan ke folder webroot
 define('CDN', 'http://cdn.slotmoo.local/'); 
 define('DEFAULT_PP',CDN.'files/photo_profiles/default.png');
 
// App::uses('SessionComponent', 'Controller/Component');
App::uses('CakeSession', 'Model/Datasource');

// now create new SessionComponent instance
//$Session = new SessionComponent();
//debug(CakeSession::read());
//debug(CakeSession::check('Auth.User.id'));
// check if the user logged in
//if ($Session->read('Auth.User')) {
if(CakeSession::check('Auth.User.id')) {
	// set the default routing to submissions controller
	Configure::write('Route.default', array('member'=>false,'controller' => 'listings', 'action' => 'index'));
	//Configure::write('Route.admin', array('plugin'=>'back_end','admin'=>true,'controller' => 'users','action' => 'index'));
}
// nope, user not logged in
else {
	// set the default routing to our login page in users controller
	Configure::write('Route.default', array('controller' => 'pages', 'action' => 'display','home'));
	//Configure::write('Route.admin', array('controller' => 'users', 'action' => 'view','admin'));
}

    Configure::write('Config.language', 'eng');

    Configure::write('Config.maintenance',
        array(
            'is_maintenance'=>false,
            'access_code'=>'adalah',
            'msg'=>'We are in maintenance session, we would be back shortly. Thanks',
            'allowed'=>array('127.0.0.2')
        )
    );
    
    Configure::write('Config.feedback_types',
        array(
            'Improvement'=>__('Improvement',true),
            'Report Bug'=>__('Report Bug',true)
        )
    );
    
    Configure::write('Config.Invalid',
        array(
            'usernames'=>array(
	            //Reserved user level
	            'admin','administrator','manager','editor','moderator',
                //Reserved page url
	            'register','login','faq','about','home','all','feedback','browse','ads',
                //Dummy usernames
	            'test','user','username',
	            //Apps Controllers
	            'app','categories','comments','image_listings','keywords','listings','pages','pipes','users'
            )
        )
    );
    
    
    Configure::write('App.defaultEmail', 'support@' . env('HTTP_HOST'));

