<?php
class CronShell extends AppShell {

	public function remove_symlinks() {

		ClassRegistry::init('User')->remove_symlinks();

	}

	public function import_nats_members() {
		$this->loadModel('NatsMember');
		$this->NatsMember->importMembers();

	}
}
