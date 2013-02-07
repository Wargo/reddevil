<?php
class User extends AppModel {

	public $name = 'User';

	public $virtualFields = array(
		'name' => 'CONCAT_WS(" ",User.first_name, User.last_name)'
	);

	//Tipos de usuarios - redefinidos en la funcion __construct
	public $groups = array();

	public $virtualFieldTypes = array('name' => 'string');

	//Campos de búsqueda en texto abierto
	public $searchableFields = array('name', 'email');

/**
 * actsAs property
 *
 * @var array
 * @access public
 */
	public $actsAs = array(
		'MiUsers.UserAccount' => array(
			'passwordPolicy' => 'weak',
			'token' => array('length' => 10, 'fields' => array('email'), 'expires' => false),
			'fields' => array('username' => 'email', 'confirmation' => 'email'),
			'sendEmails' => array(
				'welcome' => array('subject' => 'Tu cuenta ha sido creada en Red Devil X'),
				'accountChange' => false
			)
		),
		//'MiEnums.Enum' => array('group'),
	);

	public function __construct($id = false, $table = null, $ds = null) {
		$this->validate = array(
			'username' => array(
				'missing' => array(
					'rule' => 'notEmpty',
					'last' => true,
					'message' => __('El nombre de usuario es obligatorio', true)
				),
				'tooShort' => array(
					'rule' => array('minLength', 5),
					'last' => true,
					'message' => __('El nombre de usuario debe tener al menos 5 carácteres', true)
				),
				'isUnique' => array(
					'rule' => 'isUnique',
					'message' => __('El nombre de usuario ya existe en nuestra base de datos', true)
				),
			),
			'first_name' => array(
				'missing' => array(
					'rule' => 'notEmpty',
					'message' => __('El nombre es obligatorio', true)
				)

			),
			'email' => array(
				'missing' => array(
					'rule' => 'notEmpty',
					'last' => true,
					'message' => __('El e-mail es obligatorio', true)
				),
				'email' => array(
					'rule' => 'email',
					'last' => true,
					'message' => __('No es una dirección de e-mail válida', true)
				),

				'isUnique' => array(
					'rule' => 'isUnique',
					'message' => __('El e-mail introducido ya existe en nuestra base de datos', true)
				)
			),
				

		);

		$this->groups = array(
			'admin' => __('Administrador'),
			'user' => __('Usuario')
		);

		return parent::__construct($id, $table, $ds);
	}

	public function beforeValidate() {
		if ($this->Behaviors->attached('MiUsers.UserAccount')) {
			$this->validate['password']['missing']['message'] = __('Debes escribir una contraseña', true);
			$this->validate['password']['tooShort']['message'] = __('La contraseña es demasiado corta', true);
			$this->validate['tos'][0]['message'] = __('Debes aceptar las condiciones', true);
			$this->validate['confirm']['notSame']['message'] = __('Las contraseñas no coinciden', true);
			$this->validate['current_password']['notCurrent']['message'] = __('No es tu contraseña actual', true);
			$this->validate['token']['missing']['message'] = __('Código no encontrado', true);
			$this->validate['email']['missing']['message'] = __('Email erróneo', true);
			$this->validate['password']['notChanged']['message'] = __('La nueva contraseña no ha cambiado', true);
		}
		parent::beforeValidate();
	}

	public function beforeSave($options = array()) {
		if (!empty($this->data['User']['password'])) {
			App::uses('AuthComponent', 'Controller/Component');
			$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		}
		return parent::beforeSave($options);
	}


	public function beforeDelete() {
		return parent::beforeDelete();
	}

	public function afterDelete() {
		return parent::afterDelete();
	}

/**
 * parentNode method
 *
 * @return void
 * @access public
 */
	public function parentNode() {
		return $this->Behaviors->AclPlus->parentNode($this);
	}

/**
 * findList method
 *
 * List uses with their full name if possible
 *
 * @param mixed $state
 * @param mixed $query
 * @param array $results
 * @return void
 * @access protected
 */
	public function _findList($state, $query, $results = array()) {
		if ($state === 'before' && isset($query['fields'])) {
			return parent::_findList($state, $query, $results);
		} elseif ($state === 'after' && isset($query['list'])) {
			return parent::_findList($state, $query, $results);
		}
		if (!$this->hasField('first_name') || !$this->hasField('last_name')) {
			if ($this->hasField('username')) {
				$this->displayField = 'username';
			} else {
				$this->displayField = 'email';
			}
			return parent::_findList($state, $query, $results);
		}
		if ($state == 'before') {
			$query['recursive'] = -1;
			$query['order'] = array($this->alias . '.last_name', $this->alias . '.first_name');
			$query['fields'] = array($this->alias . '.first_name', $this->alias . '.last_name', $this->alias . '.id');
			return $query;
		} elseif ($state == 'after') {
			if (empty($results)) {
				return array();
			}
			$keyPath = "{n}.{$this->alias}.id";
			//$valuePath = array('{1}, {0}',
			$valuePath = array('{0} {1}',
				'{n}.' . $this->alias . '.first_name',
				'{n}.' . $this->alias . '.last_name'
			);
			return Set::combine($results, $keyPath, $valuePath);
		}
	}
}
