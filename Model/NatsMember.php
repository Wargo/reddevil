<?php
class NatsMember extends AppModel {

	public $useDbConfig = 'nats';

	public $useTable = 'member';

	public function importMembers() {

		$User = ClassRegistry::init('User');		
		App::uses('File', 'Utility');
		$File = new File(APP . 'Config' . DS . 'Nats' . DS . 'last_import');
		$last_import = (int) $File->read();
		$conditions = array('status' => 1, 'joined >' => $last_import);
		$order = array('joined' => 'asc');
		$members = $this->find('all', compact('conditions', 'order'));

		foreach ($members as $member) {
			extract($member);
			if ($user = $User->find('first', array('conditions' => array('username' => $NatsMember['username'])))) {
				if ($user['User']['email_verified']) {
					continue;
				}
			}

			$memberid = $NatsMember['memberid'];
			$conditions = array('memberid' => $memberid);
			$order = array('expires' => 'desc');
			$memberSubscription = ClassRegistry::init('NatsMemberSubscription')->find('first', compact('conditions', 'order'));

			$caducidad = strftime('%Y-%m-%d %H:%M:%S', $memberSubscription['NatsMemberSubscription']['expires']);
			
			
			$data = array(
				'password' => $NatsMember['password'],
				'group' => 'user',
				'email_verified' => $NatsMember['mailok'],
				'email' => $NatsMember['email'],
				'username' => $NatsMember['username'],
				'first_name' => $NatsMember['original_username'],
				'second_name' => $NatsMember['original_username'],
				'active' => 1,
				'caducidad' => $caducidad,
			);
			$User->Behaviors->detach('MiUsers.UserAccount');
			if (!empty($user)) {
				$User->id = $user['User']['id'];
			} else {
				$User->create();
			}
			$return = $User->save($data);
			$User->Behaviors->attach('MiUsers.UserAccount');

			$last_import = $NatsMember['joined'];
		}
		$File->delete();
		$File->write($last_import);
	}

	//Comprobar al loguearse si el usuario sigue activo en la tabla de Nats
	public function checkActive($user) {
		$member = $this->find('first', array('conditions' => array('username' => $user['username'])));
		return ($member[$this->alias]['status'] == 1);
	}

	//Actualizar la fecha de caducidad si ha cambiado en las tablas de NATS
	public function updateSubscription($user) {
		if ($user['group'] == 'vip') {
			return false;
		}
		$member = $this->find('first', array('conditions' => array('username' => $user['username'])));
		$memberid = $member[$this->alias]['memberid'];
		$conditions = array('memberid' => $memberid);
		$order = array('expires' => 'desc');
		$memberSubscription = ClassRegistry::init('NatsMemberSubscription')->find('first', compact('conditions', 'order'));

		if ($memberSubscription['NatsMemberSubscription']['expires'] != strtotime($user['caducidad'])) {
			$User = ClassRegistry::init('User');
			$User->id = $user['id'];
			$caducidad = strftime('%Y-%m-%d %H:%M:%S', $memberSubscription['NatsMemberSubscription']['expires']);
			$User->save(array('caducidad' => $caducidad));
			return $caducidad;
		}
		return false;
	}
}
