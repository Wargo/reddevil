<?php
class Video extends AppModel {

	var $limit = 3;

	function findMore($page, $conditions) {
		
		return $this->find('all', array(
			'conditions' => $conditions,
			'limit' => 6,
			'offset' => $this->limit * $page
		));

	}

	function getVideos($page, $params = array(), $limit = false) {

		if ($limit == false) {
			$limit = $this->limit;
		}

		$ids = $conditions = array();

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

	}

	public function addFile($data) {
			$file = $data['Video']['file'];
			if ($data['Video']['video_type'] == 0) {
				//Añadir como nuevo video	
				$this->create();
				$this->save(array('title' => $file));
				$id = $this->id;	
			} else {
				$id = $data['Video']['id'];
			}
			$orig = APP . 'raw' . DS . $file;
			$movie = new ffmpeg_movie($orig);

			if ($data['Video']['mode'] == 'trailer') {
				$dest = Configure::read('TrailerUploadFolder') . $id;
				$imageFolder = Configure::read('TrailerImageFolder');
				$formats = serialize(array('Trailer' => array('mp4' => true)));
				$data = array('has_trailer' => 1, 'trailer_duration' => $movie->getDuration(), 'formats' => $formats);
			} else {
				$dest = Configure::read('VideoUploadFolder') . $id;
				$imageFolder = Configure::read('VideoImageFolder');
				$formats = serialize(array('Video' => array('mp4' => true)));
				$data = array('has_video' => 1, 'duration' => $movie->getDuration(), 'formats' => $formats);
			}
			
			if (Configure::read('GenerateScreenshots')) {
				$duration = $movie->getDuration();
				$framerate = $movie->getFrameRate();
				$step = round (($duration*$framerate)/7);
				for ($i = 1; $i <= 6; $i ++) {
					$frame = $i * $step;
					$frame = $movie->getFrame($frame);
					$image = $frame->toGDImage();
					imagejpeg($image, $imageFolder . $id . '-' . $i . '.jpg');		
				}
			}
			str_replace(' ', '\ ', $orig);
			exec("mv $orig $dest");
			$this->id = $id;
			return $this->save($data);
	}

	function isPrivate($video_id, $session) {

		if (empty($session['video_' . $video_id]) || $session['video_' . $video_id] < date('Y-m-d H:i:s', mktime(date('H'),date('i'),date('s'),date('m'),date('d') - 1, date('Y')))) {
			return true;
		} else {
			return false;
		}

	}

	function getSlug($video_id) {
		return $this->field('slug', array('id' => $video_id));
	}

}
