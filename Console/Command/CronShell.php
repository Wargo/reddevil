<?php
class CronShell extends AppShell {

	public function remove_symlinks() {

		ClassRegistry::init('User')->remove_symlinks();

	}

	public function import_nats_members() {
		$this->loadModel('NatsMember');
		$this->NatsMember->importMembers();
	}

	function createVIP() {
		if (!empty($this->args[0])) {
			$username = $this->args[0];
		}
		if (!empty($this->args[1])) {
			$password = $this->args[1];
		}
		if (!empty($username) && !empty($password)) {
			$this->out('Creando usuario VIP. Username: ' . $username . ', password: ' . $password);
			ClassRegistry::init('User')->create_vip($username, $password);
		} else {
			$this->out('Error. Debes de ejecutar el comando createVIP [username] [password]');
		}
	}
}
