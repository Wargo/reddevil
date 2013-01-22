<?php
class Photo extends AppModel {

	function getPhotos($video_id) {

		return $this->find('all', array(
			'conditions' => array(
				'video_id' => $video_id,
			),
		));

	}

}
