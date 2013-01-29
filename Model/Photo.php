<?php
class Photo extends AppModel {

	var $belongsTo = array('Video');

	public $actsAs = array(
		'Media.Transfer' => array(
			'trustClient' => false,
			'transferDirectory' => MEDIA_TRANSFER,
			'createDirectory' => true,	
		),
	);

	function getPhotos($video_id, $limit = 0) {

		return $this->find('all', array(
			'conditions' => array(
				'video_id' => $video_id,
			),
			'limit' => $limit
		));

	}

	function getPhotosByActor($actor_id, $limit = 0) {

		$ids = ClassRegistry::init('PhotoRelationship')->find('list', array(
			'conditions' => array(
				'model' => 'Actor',
				'foreign_id' => $actor_id,
			),
			'fields' => array('id', 'photo_id'),
		));

		return $this->find('all', array(
			'conditions' => array(
				'Photo.id' => $ids,
				'Photo.active' => 1,
			),
			'limit' => $limit,
		));

	}

	function getTitle($Photo) {

		$actors = ClassRegistry::init('PhotoRelationship')->getActors($Photo['id']);
		if (count($actors) > 1) {
			$last = array_pop($actors);
			return sprintf(__('Fotos de %s y %s en %s'), implode(', ', $actors), $last, $Photo['title']);
		} else {
			return sprintf(__('Fotos de %s en %s'), implode(', ', $actors), $Photo['title']);
		}

	}

}
