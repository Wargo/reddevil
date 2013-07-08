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
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array('Html', 'Form', 'Session',  'Funciones', 'MiAsset.Asset');

	public $components = array(
		'Security' => array('csrfUseOnce' => false),
		'Session',
		'Mi.SwissArmy' => array('autoLayout' => true, 'authLoginSessionToken' => false),
		'MiUsers.RememberMe' => array('auth' => array('fields' => array('username' => 'email', 'password' => 'password'))),
		'Auth' => array(
				'authenticate' => array(
					'Form' => array(
						'fields' => array('username' => 'username')
					)
				),
				'loginAction' => array(
					'controller' => 'users',
					'action' => 'login',
					'plugin' => false
				),
		),
		'Cookie',
		'RequestHandler'
	);

	function beforeFilter() {

		//debug($this->params);

		$this->Auth->allow('*');
		parent::beforeFilter();	
		if (!empty($this->params['admin'])) {

			if ($this->Auth->user('group') != 'admin') {
				return $this->redirect('/');
			}

			$this->layout = 'panel';

		}

		if (isset($this->params->query['nats'])) {
			$this->Session->write('NatsCode', $this->params->query['nats']);
		}

 	 	$this->Cookie->name = 'RedDevilX';
		$this->Cookie->time = 3600 * 24;  // or '1 hour'

		$this->_detectarMovil();

		$this->_checkActive();
	}

	protected function _message($message, $url = false, $value = false, $error = false, $admin=0){
		/*
		if($this->historico>0){
			$entrada['HistoricoEntrada']['ip']=ip2long($_SERVER['REMOTE_ADDR']);

			if($this->Session->check('Administrador.id')){
				$administrador_id=$this->Session->read('Administrador.id');
				$admin=1;
			}
			else{
				$administrador_id=0;
				//$admin=0;
			}

			if($this->Session->check('Usuario.usuario')){
				$entrada['HistoricoEntrada']['usuario_id']=$this->Session->read('Usuario.id');
			}

			$entrada['HistoricoEntrada']['admin']=$admin;
			$entrada['HistoricoEntrada']['administrador_id']=$administrador_id;
			if(isset($_SERVER['REQUEST_URI'])){
				$current = $_SERVER['REQUEST_URI'];
			}
			else{
				$current="";
			}
			$entrada['HistoricoEntrada']['accion']=$current;
			if ($value) {
				$mensaje = sprintf($message, $value);
			}
			else{
				$mensaje=$message;
			}
			$entrada['HistoricoEntrada']['mensaje']=$mensaje;
			if($error){
				$entrada['HistoricoEntrada']['error']=1;
			}
			$this->HistoricoEntrada->create();
			$this->HistoricoEntrada->save($entrada);
		}
		*/
		if ($value) {
			$message = sprintf($message, '<strong>' . $value . '</strong>');
		}
		if ($error) {
			$message = '<div class="mensaje error">' . $message . '</div>';
		} else {
			$message = '<div class="mensaje confirmation">' . $message . '</div>';
		}
		$this->Session->setFlash($message, '');
		if ($url) {
			$this->redirect($url);
		}
	}
/*
 * _detectarMovil - Detectar si se accede desde un movil o al subdominio m. y redirigir a la vista de móvil si procede
*/
	protected function _detectarMovil() {

			$domain = $_SERVER['SERVER_NAME'];
			$userAgent = $_SERVER['HTTP_USER_AGENT'];

			//Tipos de dispositivos/browsers móviles
			$agents = array('Android', 'iPhone', 'BlackBerry', 'Blazer', 'Symbian', 'Dorothy', 'Fennec', 'GoBrowser', 'Windows Phone', 'IEMobile',
				'Maemo Browser', 'MIB/2.2', 'Minimo', 'NetFront', 'Opera Mini', 'Opera Mobi', 'SEMC-Browser', 'Skyfire', 'TeaShark', 
				'Teleca', 'uZardWeb', 'Mobile Safari');
			$mobileDevice = false;
			foreach ($agents as $agent) {
				if (strpos($userAgent, $agent) !== false) {
					$mobileDevice = true;
					break;
				}
			}

			$this->set(compact('mobileDevice'));

	}

	protected function _checkActive() {

		if ($this->Auth->user('id')) {
			
			if (strtotime($this->Auth->user('last_active')) < strtotime("-10 seconds")) {

				$this->loadModel('User');

				$this->User->id = $this->Auth->user('id');

				$now = date('Y-m-d H:i:s');

				$this->User->save(array('last_active' => $now));

				$this->Session->write('Auth.User.last_active', $now);

			}

		}	

	}
}
