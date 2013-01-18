<?php
class ArchivosController extends AppController {
	
	public $uses = array();

	public function admin_index() {
		$dir = APP . 'raw';
		$archivos = scandir($dir);
		$this->set(compact('archivos'));
	}
}
