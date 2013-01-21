<?php
class VideoRelationship extends AppModel {

	function getCategories($video_id) {

		$model = 'Category';

		$ids = $this->find('list', array(
			'conditions' => compact('video_id', 'model'),
			'fields' => array('foreign_id')
		));

		return ClassRegistry::init('Category')->find('list', array(
			'conditions' => array('id' => $ids),
			'fields' => array('id', 'name'),
		));

	}

	function getActors($video_id) {

		$model = 'Actor';

		$ids = $this->find('list', array(
			'conditions' => compact('video_id', 'model'),
			'fields' => array('foreign_id')
		));

		return ClassRegistry::init('Actor')->find('list', array(
			'conditions' => array('id' => $ids),
			'fields' => array('id', 'name'),
		));

	}

}
