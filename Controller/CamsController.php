<?php
class CamsController extends AppController {

	var $paginate;

	function index() {

		$cams = array(1, 2, 3, 4);

		$this->set(compact('cams'));

	}

}
