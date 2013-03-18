<?php
class Video extends AppModel {

	var $limit = 3;

	var $domain = 'http://www.reddevilx.com';

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

		foreach ($params as $key => $slug) {
			$id = ClassRegistry::init(ucwords($key))->field('id', compact('slug'));
			$new_ids = ClassRegistry::init('VideoRelationship')->find('list', array(
				'conditions' => array(
					'model' => ucwords($key),
					'foreign_id' => $id
				),
				'fields' => array('id', 'video_id'),
			));
			$ids = array_merge($ids, $new_ids);
		}

		if (count($ids)) {
			$conditions['id'] = $ids;
		}

		
		$ips = array('84.123.66.33', '127.0.0.1');
		if (empty($_SERVER['REMOTE_ADDR']) || in_array($_SERVER['REMOTE_ADDR'], $ips)) {
			$conditions['published <='] = date('Y-m-d H:i:s');
		} else {
			$conditions['published <='] = date('Y-m-d H:i:s');
		}
		$conditions['active'] = 1;


		$count = $this->find('count', compact('conditions'));

		$pageCount = ceil($count / $limit);

		$order = array('published' => 'desc');

		return array($conditions, $pageCount, $this->find('all', compact('conditions', 'limit', 'page', 'order')));

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
				$dest = Configure::read('TrailerUploadFolder') . $id . '.mp4';
				$imageFolder = Configure::read('TrailerImageFolder');
				$formats = serialize(array('Trailer' => array('mp4' => true)));
				$data = array('has_trailer' => 1, 'trailer_duration' => $movie->getDuration(), 'formats' => $formats);
			} else {
				$dest = Configure::read('VideoUploadFolder') . $id . '.mp4';
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
			$orig = escapeshellarg($orig);
			exec("mv $orig $dest");
			if (file_exists($orig)) {
				return false;
			}
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

	function getTitle($Video) {

		$actors = ClassRegistry::init('VideoRelationship')->getActors($Video['id']);
		$actors = Set::extract('/Actor/name', $actors);
		if (count($actors) > 1) {
			$last = array_pop($actors);
			return sprintf(__('%s y %s en %s'), implode(', ', $actors), $last, $Video['title']);
		} else {
			return sprintf(__('%s en %s'), implode(', ', $actors), $Video['title']);
		}

	}

	function title2url($title) {   
		$title = str_replace('-', ' ', $title);
		$title = explode(' ', $title);
		$aux = array();
		foreach($title as $t) {
			if($t !== '') {
				$aux[] = trim($t);
			}   
		}   

		$title = implode('-', $aux);
		$original = array('á', 'é', 'í', 'ó', 'ú', 'ý', 'Á', 'É', 'Í', 'Ó', 'Ú', 'Ý', 'à', 'è', 'ì', 'ò', 'ù', 'À', 'È', 'Ì', 'Ò', 'Ù',
				'â', 'ê', 'î', 'ô', 'û', 'Â', 'Ê', 'Î', 'Ô', 'Û', 'ñ', 'Ñ', 'ç', 'Ç',
				);  
		$replace  = array('a', 'e', 'i', 'o', 'u', 'y', 'A', 'E', 'I', 'O', 'U', 'Y', 'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U',
				'a', 'e', 'i', 'o', 'u', 'A', 'E', 'I', 'O', 'U', 'n', 'N', 'c', 'C',
				);  
		$title = str_replace($original, $replace, $title);
		$title = ereg_replace("[^A-Za-z0-9\-]", "", $title);
		return $title = strtolower($title);
	} 

	function generateSitemap() {

		$this->xml = new File(WWW_ROOT . 'sitemap.xml');
		if ($this->xml->exists()) {
			$this->xml->delete();
		}	

		$this->xml->append('<?xml version="1.0" encoding="UTF-8"?>'."\r\n");
		$this->xml->append('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\r\n");

		$conditions = array('active' => 1);
		$videos = $this->find('all', compact('conditions'));

		foreach ($videos as $video) {

			extract($video);

			$this->xml->append("\t".'<url>'."\r\n");
			$this->xml->append("\t\t".'<loc>' . $this->domain . Router::url(array('controller' => 'videos', 'action' => 'view', $Video['slug'])) . '</loc>' . "\r\n");
			$this->xml->append("\t\t".'<lastmod>'.date('c').'</lastmod>'."\r\n");
			$this->xml->append("\t".'</url>'."\r\n");

			$this->xml->append("\t".'<url>'."\r\n");
			$this->xml->append("\t\t".'<loc>' . $this->domain . Router::url(array('controller' => 'videos', 'action' => 'view_photos', $Video['slug'])) . '</loc>' . "\r\n");
			$this->xml->append("\t\t".'<lastmod>'.date('c').'</lastmod>'."\r\n");
			$this->xml->append("\t".'</url>'."\r\n");

		}

		$actors = ClassRegistry::init('Actor')->find('all');

		foreach ($actors as $actor) {

			extract($actor);

			$this->xml->append("\t".'<url>'."\r\n");
			$this->xml->append("\t\t".'<loc>' . $this->domain . Router::url(array('controller' => 'videos', 'action' => 'home', 'actor' => $Actor['slug'], 'gender' => $Actor['gender'], 'page' => 1)) . '</loc>' . "\r\n");
			$this->xml->append("\t\t".'<lastmod>'.date('c').'</lastmod>'."\r\n");
			$this->xml->append("\t".'</url>'."\r\n");

			$this->xml->append("\t".'<url>'."\r\n");
			$this->xml->append("\t\t".'<loc>' . $this->domain . Router::url(array('controller' => 'photos', 'action' => 'view', 'actor' => $Actor['slug'], 'gender' => $Actor['gender'], 'page' => 1)) . '</loc>' . "\r\n");
			$this->xml->append("\t\t".'<lastmod>'.date('c').'</lastmod>'."\r\n");
			$this->xml->append("\t".'</url>'."\r\n");

		}

		$categories = ClassRegistry::init('Category')->find('all');

		foreach ($categories as $category) {

			extract($category);

			$this->xml->append("\t".'<url>'."\r\n");
			$this->xml->append("\t\t".'<loc>' . $this->domain . Router::url(array('controller' => 'videos', 'action' => 'home', 'category' => $Category['slug'], 'page' => 1)) . '</loc>' . "\r\n");
			$this->xml->append("\t\t".'<lastmod>'.date('c').'</lastmod>'."\r\n");
			$this->xml->append("\t".'</url>'."\r\n");

		}

		$this->xml->append('</urlset>');

	}


}
