<?php
class Photo extends AppModel {

	public $actsAs = array(
		'Media.Transfer' => array(
			'trustClient' => false,
			'transferDirectory' => MEDIA_TRANSFER,
			'createDirectory' => true,	
		),
	);

	function getPhotos($video_id) {

		return $this->find('all', array(
			'conditions' => array(
				'video_id' => $video_id,
			),
		));

	}

}
