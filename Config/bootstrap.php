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
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Cache Engine Configuration
 * Default settings provided below
 *
 * File storage engine.
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'File', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path
 * 		'prefix' => 'cake_', //[optional]  prefix every cache file with this string
 * 		'lock' => false, //[optional]  use file locking
 * 		'serialize' => true, // [optional]
 * 		'mask' => 0666, // [optional] permission mask to use when creating cache files
 *	));
 *
 * APC (http://pecl.php.net/package/APC)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Apc', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 *
 * Xcache (http://xcache.lighttpd.net/)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Xcache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional] prefix every cache file with this string
 *		'user' => 'user', //user from xcache.admin.user settings
 *		'password' => 'password', //plaintext password (xcache.admin.pass)
 *	));
 *
 * Memcache (http://memcached.org/)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Memcache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 		'servers' => array(
 * 			'127.0.0.1:11211' // localhost, default port 11211
 * 		), //[optional]
 * 		'persistent' => true, // [optional] set this to false for non-persistent connections
 * 		'compress' => false, // [optional] compress data in Memcache (slower, but uses less memory)
 *	));
 *
 *  Wincache (http://php.net/wincache)
 *
 * 	 Cache::config('default', array(
 *		'engine' => 'Wincache', //[required]
 *		'duration'=> 3600, //[optional]
 *		'probability'=> 100, //[optional]
 *		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 *	));
 */
Cache::config('default', array('engine' => 'File'));

CakePlugin::loadAll();

App::uses('File', 'Utility'); 
App::uses('Folder', 'Utility'); 

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


define('MEDIA_TRANSFER', APP . 'uploads' . DS);


// 803
/*
Configure::write('CID', 'FA_7509_01_001');
Configure::write('pass', 'gr5p4pr3x1');
Configure::write('pool', 1);
*/


// 905
Configure::write('CID', 'FA_7509_900_001');
Configure::write('pass', 'c1b4n4v1l');
Configure::write('pool', 900);
Configure::write('info', __('Servicio exclusivamente para adultos prestado por Sistemas de Micropago, Sl. Apdo. de Correos 14.953 - 28080 Madrid. Cte. 1.45€/llamada desde fijo y 2€/llamada desde móvil I.V.A incluido.'));

// SMS 1.20€ + IVA
Configure::write('CID_m1', 'FA_7509_SMS_3');
Configure::write('pass_m1', 'n1p5l2s');
Configure::write('pool_m1', 94);
Configure::write('info_m1', __('WPR,S.A. Cte sms 1.45€ I.V.A incl., sms@wpr.es Nº atn clte 902044008. Apdo. Correos 14.953 - 28080 Madrid'));

// SMS 7€ + IVA
Configure::write('CID_m', 'FA_7509_SMS_2');
Configure::write('pass_m', 'g2n2r3c42');
Configure::write('pool_m', 88);
Configure::write('info_m', __('WPR,S.A. Cte sms 7.26€ I.V.A incl. , sms@wpr.es Nº atn clte 902044008. Apdo. Correos 14.953 - 28080 Madrid'));

$formats = array(
	'mp4' => array('folder' => 'mp4', 'sizes' => array('m', 's')),
	'flv' => array('folder' => 'flv', 'sizes' => array('l', 'm', 's')), 
	'wmv' => array('folder' => 'wmv', 'sizes' => array('l', 'm', 's')),
	'ogg' => array('folder' => 'ogg', 'sizes' => array('l', 'm', 's')),
	'v3gp' => array('folder' => '3gp', 'sizes' => array('s'))
);
Configure::write('formats', $formats);


/**
 * isproduction method
 * a stub/example
 *
 * @return boolean
 * @access public
 */

function isProduction() {

    return APP_DIR === 'live';

}



/**
 * isstaging method
 * a stub/example
 *
 * @return boolean
 * @access public
 */

function isStaging() {

    return APP_DIR === 'staging';

}



/**
 * isdevelopment method
 * a stub/example
 *
 * @return boolean
 * @access public
 */

function isdevelopment() {

    return (!isProduction() && !isStaging());

}


App::import('Vendor', 'Funciones');

setlocale(LC_ALL, 'es_ES');
