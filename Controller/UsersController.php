<?php
class UsersController extends AppController {

/**
 * name property
 *
 * @var string 'Users'
 * @access public
 */
	public $name = 'Users';

/**
 * postActions property
 *
 * @var array
 * @access public
 */
	public $postActions = array(
		'admin_delete',
		'admin_sudo',
	);

	var $paginate = array(
	        'limit'=>25,
        	'order'=>array('User.created'=>'DESC')
        );

/**
 * beforeFilter method -
 *
 * Set the black hole to prevent white-screen-of-death symptoms for invalid form submissions.
 *
 * @access public
 * @return void
 */
	public function beforeFilter() {
		parent::beforeFilter();
		if(in_array($this->params['action'], array('edit', 'admin_edit', 'register', 'reset_password', 'admin_index', 'register'))) {
			$this->Security->validatePost = false;
		}
		$this->set('authFields', $this->Auth->fields);
		$this->Auth->allow(
			'confirm',
			'forgotten_password',
			'index',
			'login',
			'logout',
			'profile',
			'register',
			'register_popup',
			'reset_password',
			'switch_language'
		);
		$this->Auth->autoRedirect = false;
		if (isset($this->Security)) {
			$this->Security->blackHoleCallback = '_blackHole';
		}

	}

/**
 * beforeRender method
 *
 * @return void
 * @access public
 */
	public function beforeRender() {
		if (!empty($this->request->data['User'])) {
			unset($this->request->data['User'][$this->Auth->fields['password']]);
			unset($this->request->data['User']['confirm']);
			unset($this->request->data['User']['current_password']);
		}
		return parent::beforeRender();
	}

	function admin_index() {

		/*
		 * 'alomojó' convendría mover esta decisión al beforeRender de esta clase
		 */

		if (!$this->Session->read('dir_comercial')) {
			$this->redirect('/');
		}
		if(!isset($this->params['named']['group'])){
			if (empty($this->request->data)) {	
				$this->redirect(array('group' => 'api'));
			} else {
				$this->request->data['User']['group'] = 'api';
			}
		}
		switch($this->params['named']['group']){
			case 'api': $this->categoria_admin=MENU_ADMIN_APIS;
						$this->User->bindModel(array('hasOne'=>array('Api'=>array('className'=>'Api','foreignKey'=>'id'))));
						break;
			case 'callcenter': $this->categoria_admin=MENU_ADMIN_PROPIETARIOS;
						break;

			case 'delegado': $this->categoria_admin=MENU_ADMIN_DELEGADOS;
						break;
			case 'admin':
				if ($this->Session->read('nivel')<1) {
					$this->redirect(array('group' => 'api'));
				}
			default:
						$this->categoria_admin=MENU_ADMIN_ADMINISTRADORES;
						break;
		}
		
		$conditions = $this->_parseSearch();
		if (isset($this->params['named']['homologado']) && $this->params['named']['homologado'] != '') {
			$this->loadModel('Api');
			$_conditions = array('homologado' => $this->params['named']['homologado']);
			$user_ids = array_keys($this->Api->find('list', array('conditions' => $_conditions)));
			$conditions['User.id'] = $user_ids;
			$this->request->data['User']['homologado'] = $this->params['named']['homologado'];
		}

		$users = $this->paginate($conditions);

		$this->set(compact('users'));
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->_message(__('Invalid user'), array('action' => 'index'), null, true);
		}
		$this->set('user', $this->User->read(null, $id));
	}


	function admin_editar($id = null) {
		if (!$this->Session->read('dir_comercial')) {
			$this->redirect('/');
		}

		if (!$id && !empty($this->request->data['User']['id'])) {
			$id = $this->request->data['User']['id'];
		}

		$this->_acceso($id);

		if (!empty($this->request->data)) {
			$welcomeMail=false;
			if ($id) {
				$this->User->id = $id;
			} else {	
				if($this->request->data['User']['group']=='admin' && ($this->Session->read('nivel')<1)){
					$this->request->data['User']['group'] = 'api';
				}
				$this->User->create();
				if($this->request->data['User']['group']=='api'){
					$welcomeMail=true;
				}
			}
			
			 if($welcomeMail){       
				$this->User->actAs=array('MiUsers.UserAccount' => array(
                        	'sendEmails' => array(
								'welcome' => array('subject' => __('Tu cuenta de comercializador ha sido registrada')),
								'accountChange' => false
							)
				));			
            }

			if ($this->User->save($this->request->data)) {
				if (!$id) {
					$id = $this->User->id;
					$registro_api['Api']['id']=$id;
					$registro_api['Api']['nombre']=$this->request->data['User']['first_name'].' '.$this->request->data['User']['last_name'];
					$this->loadModel('Api');
					$this->Api->create();
					$this->Api->save($registro_api);
			
				}
				if (empty($id)) {
					$id = $this->User->id;
				}
				if ($this->request->data['User']['group'] == 'admin') {
					$controller = 'administradores';

				} else if ($this->request->data['User']['group'] == 'admin') {
					$controller = 'administradores';
				} else {
					$controller = Inflector::pluralize($this->request->data['User']['group']);
				}
				$this->_message(__('Usuario guardado'), array('controller' => $controller, 'action' => 'editar', $id ), null, true);
			} else {
				$this->_message(__('No se pudo guardar el usuario. Por favor, vuelve a intentarlo.'), false, null, true);
			}
		}
		if (empty($this->request->data) && $id) {
			$this->request->data = $this->User->read(null, $id);
		}
		$this->set(compact('id'));
		$this->_setSelects();
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->_message(__('Usuario incorrecto'), array('action' => 'index'), null, true);
		}
		if ($this->User->delete($id)) {
			$this->_message(__('Usuario eliminado'), array('action' => 'index'), null, true);
		}
		$this->_message(__('No se pudo eliminar el usuario'), array('action' => 'index'), null, true);
	}

	function admin_cambiar_contrasena($id = null) {
		if (!$id) {
			$this->_message(__('Usuario incorrecto', true), array('action'=>'index'), null, true);
		}
		$user = $this->User->read(null, $id);
		if (!empty($this->request->data)) {
			if ($user) {
				list($return, $message) = $this->User->changePassword($this->request->data, $user);
				$this->_message($message, false, null, true);
			} else {
				$this->_message(__('Usuario incorrecto'), false, null, true);
			}
		}
		$this->set(compact('id', 'user'));
	}

	function propietario_cambiar_contrasena($id = null) {
		if (!$id || ($id != $this->Auth->user('id'))) {
			$this->_message(__('Invalid id for user'), false, null, true);
		}
		$user = $this->User->read(null, $id);

		if (!empty($this->request->data)) {
			if ($user) {
				list($return, $message) = $this->User->changePassword($this->request->data, $user);
				$this->_message($message, $this->referer(), null, true);
			} else {
				$this->_message(__('Usuario incorrecto'), false, null, true);
			}
		}
		$this->set(compact('id', 'user'));
	}

	function api_cambiar_contrasena($id = null) {
		$this->propietario_cambiar_contrasena($id);
	}


	function delegado_cambiar_contrasena($id = null) {
		$this->propietario_cambiar_contrasena($id);
	}

/*
 * Funciones para modificar los datos del propio usuario logueado
 *
 */

	public function admin_mi_cuenta() {
		$this->request->data = array();
		$this->request->data['User'] = $this->Auth->user();
		$this->loadModel('Administrador');
		$this->request->data = array_merge($this->request->data, $this->Administrador->read(null, $this->Auth->user('id')));
	}


	public function admin_modificar() {
		$this->_modificar();
	}


	protected function _modificar() {
		if (!empty($this->request->data)) {
			$this->User->id = $this->Auth->user('id');
			if ($this->User->save($this->request->data)) {
				$this->Session->write('Auth', $this->User->read(null, $this->Auth->user('id')));
				$this->_message(__('Usuario guardado'), false, null , false);
			} else {
				$this->_message(__('Error al guardar el usuario'), false, null, true);
			}
		}
		$this->redirect($this->referer());
	}



/**
 * change_password method
 *
 * Used for changing the password of a logged in user
 *
 * @return void
 * @access public
 */
	public function change_password() {
		if ($this->request->data) {
			list($return, $message) = $this->User->changePassword($this->request->data, $this->Auth->user());
			if ($message) {
				$this->_message($message, false, null, true);
			}
			if ($return) {
				return $this->redirect('/');
			}
		}
	}

/**
 * delete_account method
 *
 * Desactiva la cuenta del propio usuario
 *
 * @return void
 * @access public
 */
	public function delete_account() {
		if (!empty($this->request->data)) {
			$password = $this->User->field('password', array('id' => $this->Auth->user('id')));
			if (empty($this->request->data['User']['confirm_delete'])) {
				$this->_message(__('Debes confirmar que deseas desactivar la cuenta'), false, null, true);
			} elseif ($password != $this->request->data['User']['password']) {
				$this->_message(__('La contraseña introducida es incorrecta'), false, null, true);
			} else {
				$this->User->Behaviors->detach('UserAccount');
				$this->User->id = $this->Auth->user('id');
				if ($this->User->save(array('active' => 0))) {
					$this->SwissArmy->loadComponent('Cookie');
					$this->Cookie->delete('User');
					$this->Session->destroy();
					$this->_message(__('Tu cuenta ha sido desactivada'));
				} else {
					$this->_message(__('Se produjo un error al desactivar la cuenta'), false, null, true);
				}
			}
		}
	}

/**
 * confirm method
 *
 * @param mixed $token
 * @return void
 * @access public
 */
	public function confirm($token = null, $id = null) {
		/*
		$this->set('token', $token);
		$fields = $this->User->accountFields();
		$this->set('fields', $fields);
		if (!$this->request->data) {
			return;
		}
		*/
		$email = $this->User->field('email', array('id' => $id));
		$this->request->data['User']['email'] = $email;
		$this->request->data['User']['token'] = $token;
		list($return, $message) = $this->User->confirmAccount($this->request->data);
		if ($message) {
			$this->_message($message, false, null, true);
		}
		if ($return) {
			ClassRegistry::init('User')->create_relations($email, $id);
			$this->Session->write('Auth.redirect', '/'); // Prevent auth from sending you back here
			return $this->redirect('/');
		}
	}

/**
 * edit method
 *
 * @return void
 * @access public
 */
	public function edit() {
		if ($this->request->data) {

			$user_id = $this->Auth->user('id');
			$this->request->data['Profile']['user_id'] = $user_id;
			$error = ($this->request->data['Profile']['id'] != ClassRegistry::init('Profile')->field('id', compact('user_id')));
			$this->loadModel('Profile');
			if (!$error && $this->Profile->save($this->request->data)) {
				$this->_message(__('Perfil actualizado'), false, null, true);
				return $this->_back();
			} else {
				$this->_message(__('Errores en el formulario'), false, null, true);
			}
		} else {
			$user_id = $this->Auth->user('id');
			$conditions = array('user_id' => $user_id);
			$this->request->data = ClassRegistry::init('Profile')->find('first', compact('conditions'));
		}
		$this->_setSelects();
	}

/**
 * forgotten_password method
 *
 * Send the user an email with a confirmation link/token in it. Use the $email (which could be an email or a username)
 * to find the users id. Don't send another email if there is one that is pending
 *
 * @access public
 * @return void
 */
	public function forgotten_password($email = false) {
		$this->layout = 'admin_login';
		if ($this->request->data) {
			$email = $this->request->data['User']['email'];
			if (!$email) {
				$this->_message(__('Falta el email'), false, null, true);
				return;
			}
			list($return, $message) = $this->User->forgottenPassword($this->request->data['User']['email']);
			if ($message) {
				$this->_message($message, false, null, true);
			}
			if ($return) {
				$this->redirect(array('action' => 'reset_password'));
			}
		}
	}

/**
 * index method
 *
 * @return void
 * @access public
 */
	public function index() {
		return $this->redirect('/', 301);
	}

/**
 * login method
 *
 * Only run if there is no user
 *
 * @access public
 * @return void
 */
	public function login() {
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				$this->User->id = $this->Auth->user('id');
				$user_group=$this->Auth->user('group');

				if (!empty($this->request->data['User']['remember_me'])) {
					$token = $this->User->token(null, array('length' => 100, 'fields' => array(
						$this->Auth->fields['username'], $this->Auth->fields['password']
					)));
					$this->SwissArmy->loadComponent('Cookie');
					$this->Cookie->write('User.id', $this->User->id, true, '+2 weeks');
					$this->Cookie->write('User.token', $token, true, '+2 weeks');
				}
				$display = $this->User->display();
				$this->_message(__('Bienvenido de nuevo %1$s.', $display), false, null);
				if ($this->RequestHandler->isAjax() && !empty($this->params['refresh'])) {
					return $this->redirect(array('controller' => 'videos', 'action' => 'video'));
				}
				return $this->redirect(array('controller' => 'videos', 'action' => 'videos'));
			} else {
				$this->Session->setFlash(__('Email o contraseña incorrectos'));
			}

		} elseif ($this->Auth->user('id')) {
			$user_group=$this->Auth->user('group');
			return $this->redirect(array('controller' => 'videos', 'action' => 'home'));
		}
	/*	if (Configure::read()) {
			$this->Session->setFlash('Debug only message: Save some tedium - check remember me.');
		}*/
	}

/**
 * logout method
 *
 * Delete the users cookie (if any), log them out, and send them a parting flash meassage. If no user is logged in just
 * send them back to where they came from (no reference to the session refer).
 *
 * @access public
 * @return void
 */
	public function logout() {
		$this->_logout();
		if ($this->Auth->user()) {
			$this->_message(__('¡Hasta pronto!'), false, null, true);
		}
		//$this->redirect($this->Auth->logout());
		$this->redirect('/');
	}

	protected function _logout() {
		$this->Session->destroy();
		if ($this->Auth->user()) {
			$this->SwissArmy->loadComponent('Cookie');
			$this->Cookie->delete('User');
			$this->Cookie->delete();
		}
	}

/**
 * profile method
 *
 * @param mixed $username
 * @access public
 * @return void
 */
	public function profile() {
		if (!$this->Auth->user('id')) {
			$this->redirect('/');
		}
		
		$user = $this->User->findByid($this->Auth->user('id'));
		$this->set(compact('user'));
		
		$this->render('/Elements/Users/payment');
	}

/**
 * register method
 *
 * @access public
 * @return void
 */
	public function register() {

		$override = false;

		if ($this->request->data) {
			$this->_logout();
			/*
			if (!empty($this->request->data['User']['payment'])) {
				$this->Session->write('payment', $this->request->data['User']['payment']);
			}
			*/

			if (!empty($this->request->data['User']['slug'])) {
				$slug = $this->request->data['User']['slug'];
				$loginRedirect = array('controller' => 'videos', 'action' => 'view_video', $slug);
			} else {
				$loginRedirect = array('controller' => 'videos', 'action' => 'home');	
			}


			$this->Auth->login();

			if ($this->Auth->user('id')) {
				if ($this->request->isAjax()) {
					$this->set(compact('loginRedirect'));
					$this->render('/Elements/Users/close_popup');
					return true;
				} else {
					$this->_message(__('Bienvenido de nuevo.'), $loginRedirect, null);
				}
			}

			$this->request->data['User']['group'] = 'user';
			$this->request->data['User']['active'] = 1;

			$this->User->Behaviors->detach('MiUsers.UserAccount');
			$this->User->create();
			$return = $this->User->save($this->request->data);

			$this->User->Behaviors->attach('MiUsers.UserAccount');
			if ($return) {	
				$this->Auth->login();	

				if ($this->request->isAjax()) {
					$this->render('/Elements/Users/payment');
					return true;
				} else {
					$this->_message(__('Registro finalizado.'), $loginRedirect, null);
				}
			} else {
				if ($this->request->isAjax()) {
					$this->set('errors', $this->User->validationErrors);
					$this->render('/Elements/Users/register');

				} else {
					$this->_message(__('Error al registrarse'), $loginRedirect, null, true);
				}
			}
		}
		$this->set('passwordPolicy', $this->User->passwordPolicy());
		if ($this->request->isAjax()) {
			$this->render('/Elements/Users/register');
		}
	}

	public function register_popup($slug = null) {
		if ($slug) {
			$this->loadModel('Video');
			extract($this->Video->findBySlug($slug));
			$id = $Video['id'];
		} else {
			$id = null;
		}
		$this->set(compact('slug', 'id'));
		$this->render('/Elements/payment_popup');
	}

	public function renew() {
		if (!$this->Auth->user('id')) {
			$this->redirect('/');
		}
		if (!empty($this->request->data)) {
				$this->Session->write('payment', $this->request->data['User']['payment']);
				$this->redirect(array('action' => 'payment'));
		}
	}

	public function payment($video_id = false) {
		die;
		//@TODO Hacer aquí el pago con tarjeta
		if (!$this->Auth->user('id')) {
			$this->redirect('/');
		}
		$payment = $this->Session->read('payment');
		$tCaducidad = strtotime($this->User->field('caducidad', array('id' => $this->Auth->user('id'))));
		$now = time();
		if ($tCaducidad < $now) {
			$tCaducidad = $now;
		}
		switch ($payment) {
			case 'day': $caducidad = strftime('%Y-%m-%d %H:%M:%S', strtotime('+1 day', $tCaducidad)); break;
			case 'month': $caducidad = strftime('%Y-%m-%d %H:%M:%S', strtotime('+1 month', $tCaducidad)); break;
			case '3month': $caducidad = strftime('%Y-%m-%d %H:%M:%S', strtotime('+3 months', $tCaducidad)); break;
			case 'year': $caducidad = strftime('%Y-%m-%d %H:%M:%S', strtotime('+1 year', $tCaducidad)); break;
		}

		$this->User->id = $this->Auth->user('id');
		$this->User->save(compact('caducidad'));
		
		if ($video_id) {
			$this->loadModel('Video');
			$video_id = $this->Video->field('slug', array('id' => $video_id));
		}
		$this->set(compact('video_id'));
	}

/**
 * reset_password method
 *
 * Used to set a new password after requesting a reset via the forgotten password method
 *
 * @param string $token
 * @access public
 * @return void
 */
	public function reset_password($token = null) {

		$this->set('token', $token);
		$loggedInUser = $this->User->id = $this->Auth->user('id');
		if ($loggedInUser) {
			$this->redirect(array('action' => 'change_password'));
		}
		$this->set('fields', $this->User->Behaviors->UserAccount->settings['User']['fields']);
		if (!$this->request->data) {
			return $this->render('confirm');
		}
		list($return, $message) = $this->User->resetPassword($this->request->data);
		if ($message) {
			$this->_message($message, false, null, true);
		}
		if ($return) {
			$this->Session->write('Auth.redirect', '/'); // Prevent auth from sending you back here
			return $this->redirect(array('action' => 'login'));
		}
		$view = 'confirm';
		if ($this->request->data) {
			if (empty($this->User->validationErrors[$this->Auth->fields['username']]) &&
				empty($this->User->validationErrors['token'])) {
				$view = 'reset_password';
			}
		}
		$this->render($view);
	}

/**
 * postLogin method
 *
 * Called automatically when a user logs in normally, or by cookie
 *
 * @param array $userData array()
 * @param mixed $mode 'form' or 'cookie'
 * @return void
 * @access public
 */
	public function postLogin($userData = array(), $mode = null) {
		static $run;
		if($run) {
			return;
		}
		$run = true;
		$this->User->id = $id = $this->Auth->user('id');
		$display = $this->User->display();
		/* ... */
	}

/**
 * isAuthorized method
 *
 * Allow logged in users to edit their profile and change their password
 *
 * @return bool
 * @access public
 */
	public function isAuthorized() {
		if (in_array($this->action, array('edit', 'change_password'))) {
			return true;
		}
		return parent::isAuthorized();
	}

/**
 * setSelects method
 *
 * @param bool $restrictToData true
 * @return void
 * @access protected
 */
	protected function _setSelects($restrictToData = true) {
		$groups = $this->User->groups;
		if ($this->Session->read('nivel') < 1) {
			unset($groups['admin']);
		}
		$this->set(compact('groups'));

	}

	function admin_desactivar($id=0){

		$volver=$this->referer();

		if($id!=0):

			$this->User->id=$id;
			if($this->User->exists()){
				$this->User->saveField('active',0);
				$this->_message('Registro desactivado: %s', $volver,$id);
			}
			else{
				$this->_message('ERROR: el registro %s no existe', $volver,$id,true);
			}

		else:
		if(!empty($this->request->data['seleccionado'])){
			$afectados='';
			foreach($this->request->data['seleccionado'] as $seleccionado_id=>$seleccionado){
				if($seleccionado==1){
					$this->User->id=$seleccionado_id;
					if($this->User->exists()){
						$this->User->saveField('active',0);
						$afectados.=' '.$seleccionado_id;
					}
				}
			}
			if(empty($afectados)){
				$this->_message('ERROR: no se ha desactivado ningun registro', $volver,null,true);
			}
			else{
				$this->_message('Registros desactivados:%s', $volver,$afectados);
			}
		}
		else{
			$this->_message('ERROR: el registro 0 no existe', $volver,null,true);
		}
		endif;
	}


	function admin_activar($id=0){

		$volver=$this->referer();

		if($id!=0):

		$this->User->id=$id;
		if($this->User->exists()){
			$this->User->saveField('active',1);
			$this->_message('Registro activado: %s', $volver,$id);
		}
		else{
			$this->_message('ERROR: el registro %s no existe', $volver,$id,true);
		}

		else:
		if(!empty($this->request->data['seleccionado'])){
			$afectados='';
			foreach($this->request->data['seleccionado'] as $seleccionado_id=>$seleccionado){
				if($seleccionado==1){
					$this->User->id=$seleccionado_id;
					if($this->User->exists()){
						$this->User->saveField('active',1);
						$afectados.=' '.$seleccionado_id;
					}
				}
			}
			if(empty($afectados)){
				$this->_message('ERROR: no se ha activado ningun registro', $volver,null,true);
			}
			else{
				$this->_message('Registros activados:%s', $volver,$afectados);
			}
		}
		else{
			$this->_message('ERROR: el registro 0 no existe', $volver,null,true);
		}
		endif;
	}

	protected function _acceso($id) {
		if (empty($id)) {
			return true;
		}

		$grupo = $this->User->field('group', compact('id'));

		if ($grupo == 'admin') {
			return $this->Session->read('nivel') > 0;
		}
		return true;
	}
}

