<?php
class Video extends AppModel {

	/*
	var $hasAndBelongsToMany = array(
		'Category' => array(
			'className' => 'Category',
			'joinTable' => 'video_relationships',
			'foreignKey' => 'video_id',
			'associationForeignKey' => 'foreign_id',
		),
	);
	*/

	function findMore($page, $conditions) {
		
		return $this->find('all', array(
			'conditions' => $conditions,
			'limit' => 6,
			'offset' => 3 * $page
		));

	}

}
