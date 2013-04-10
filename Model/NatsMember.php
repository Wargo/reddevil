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
			if ($User->find('first', array('conditions' => array('username' => $NatsMember['username'])))) {
				continue;
			}

			if ($NatsMember['trial']) {
				$caducidad = strftime('%Y-%m-%d %H:%M:%S', strtotime('+1 week', $NatsMember['joined']));
			} else {
				$caducidad = strftime('%Y-%m-%d %H:%M:%S', strtotime('+1 month', $NatsMember['joined']));
			}
			
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
			$User->create();
			$return = $User->save($data);	
			$User->Behaviors->attach('MiUsers.UserAccount');

			$last_import = $NatsMember['joined'];
		}
		$File->delete();
		$File->write($last_import);
	}
}
