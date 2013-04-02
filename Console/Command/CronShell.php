<?php
class CronShell extends AppShell {

	public function remove_symlinks() {

		ClassRegistry::init('User')->remove_symlinks();

	}

	public function import_nats_members() {
		$this->loadModel('NatsMember');
		$this->loadModel('User');
		
		App::uses('AuthComponent', 'Controller/Component');
		App::uses('File', 'Utility');
		$File = new File(APP . 'Config' . DS . 'Nats' . DS . 'last_import');
		$last_import = (int) $File->read();
		$conditions = array('status' => 1, 'joined >' => $last_import);
		$order = array('joined' => 'asc');
		$members = $this->NatsMember->find('all', compact('conditions', 'order'));

		foreach ($members as $member) {
			extract($member);
			if ($this->User->find('first', array('conditions' => array('username' => $NatsMember['username'])))) {
				continue;
			}
			
			$data = array(
				'password' => $NatsMember['password'],
				'group' => 'normal',
				'email_verified' => $NatsMember['mailok'],
				'email' => $NatsMember['email'],
				'username' => $NatsMember['username'],
				'first_name' => $NatsMember['original_username'],
				'second_name' => $NatsMember['original_username'],
				'active' => 1,
				'caducidad' => strftime('%Y-%m-%d %H:%M:%S', strtotime('+1 month', $NatsMember['joined'])),
			);
			$this->User->Behaviors->detach('MiUsers.UserAccount');
			$this->User->create();
			$return = $this->User->save($data);
			$this->User->Behaviors->attach('MiUsers.UserAccount');

			$last_import = $NatsMember['joined'];
		}
		$File->delete();
		$File->append($last_import);
	}
}
