<?php
class PhotoRelationship extends AppModel {

	function getCategories($photo_id) {

		$model = 'Category';

		$ids = $this->find('list', array(
			'conditions' => compact('photo_id', 'model'),
			'fields' => array('foreign_id')
		));

		return ClassRegistry::init('Category')->find('list', array(
			'conditions' => array('id' => $ids),
			'fields' => array('id', 'name'),
		));

	}

	function getActors($photo_id) {

		$model = 'Actor';

		$ids = $this->find('list', array(
			'conditions' => compact('photo_id', 'model'),
			'fields' => array('foreign_id')
		));

		return ClassRegistry::init('Actor')->find('list', array(
			'conditions' => array('id' => $ids),
			'fields' => array('id', 'name'),
		));

	}

}
