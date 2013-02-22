<?php
class CronShell extends AppShell {

	function remove_symlinks() {

		ClassRegistry::init('User')->remove_symlinks();

	}

}
