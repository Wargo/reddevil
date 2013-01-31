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
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */
	Router::connect('/', array('controller' => 'videos', 'action' => 'home'));


	Router::connect('/videos/check_phone', array('controller' => 'videos', 'action' => 'check_phone'));
	Router::connect('/videos/check_sms', array('controller' => 'videos', 'action' => 'check_sms'));

	Router::connect('/videos/:page', array('controller' => 'videos', 'action' => 'home'));

	Router::connect('/admin', array('admin' => true, 'controller' => 'videos', 'action' => 'index'));

	Router::connect('/trailer/*', array('controller' => 'videos', 'action' => 'view'));

	Router::connect('/video/*', array('controller' => 'videos', 'action' => 'view_video'));

	Router::connect('/fotos', array('controller' => 'photos', 'action' => 'index'));

	Router::connect('/ver-fotos/*', array('controller' => 'videos', 'action' => 'view_photos'));

	Router::connect('/fotos/:page', array('controller' => 'photos', 'action' => 'index'));

	Router::connect('/fotos-de/:actor/:page', array('controller' => 'photos', 'action' => 'view'));

	Router::connect('/actriz/:actor/:page', array('controller' => 'videos', 'action' => 'home', 'gender' => 0));

	Router::connect('/actor/:actor/:page', array('controller' => 'videos', 'action' => 'home', 'gender' => 1));

	Router::connect('/categoria/:category/:page', array('controller' => 'videos', 'action' => 'home'));


	Router::connect('/quiero-ser-actriz-porno', array('controller' => 'pages', 'action' => 'display', 'wannabe'));

	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));



/**
 * Connect media types to media plugin
 */
	Router::connect(
        '/:mediaType/*',
        array('plugin' => 'media', 'controller' => 'media', 'action' => 'serve'),
        //array('controller' => 'media', 'action' => 'serve'),
        array('mediaType' => '(aud|doc|gen|ico|img|txt|vid)')
	);

/**
 * Load all plugin routes.  See the CakePlugin documentation on 
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();

/**
 * Load the CakePHP default routes. Remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
