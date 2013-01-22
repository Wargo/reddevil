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

	function getVideos($page, $limit, $params = array()) {

		$ids = $conditions = array();

		//$this->loadModel('VideoRelationship');
		foreach ($params as $key => $value) {
			$new_ids = ClassRegistry::init('VideoRelationship')->find('list', array(
				'conditions' => array(
					'model' => ucwords($key),
					'foreign_id' => $value
				),
				'fields' => array('id', 'video_id'),
			));
			$ids = array_merge($ids, $new_ids);
		}

		if (count($ids)) {
			$conditions['id'] = $ids;
		}

		$conditions['active'] = 1;

		$count = $this->find('count', compact('conditions'));

		$pageCount = ceil($count / $limit);

		return array($conditions, $pageCount, $this->find('all', compact('conditions', 'limit', 'page')));
		
		//$this->paginate['Video']['limit'] = 3;
		//$this->paginate['Video']['page'] = $page;

		//return $this->paginate($conditions);

	}

}
