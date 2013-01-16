<?php
class Video extends AppModel {

	function findMore($page) {
		
		return $this->find('all', array(
			'conditions' => array(),
			'limit' => 6,
			'offset' => 3 * $page
		));

	}

}
