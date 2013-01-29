<?php
class VideosController extends AppController {

	var $paginate = array();

	function home($page = 1) {

		list($conditions, $pageCount, $videos) = $this->Video->getVideos($page, $this->params['named']);

		$this->set(compact('videos', 'conditions', 'page', 'pageCount'));

	}

	function view($id = null) {

		if (empty($id)) {
			return $this->redirect('/');
		}

		$section = 'trailer';

		if (!$video = $this->Video->findById($id)) {
			$video = $this->Video->findBySlug($id);
		}
		extract($video);

		$title_for_layout = $this->Video->getTitle($Video);

		$this->set(compact('Video', 'section', 'layout_title', 'title_for_layout'));

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$this->render('/Elements/Videos/player');
		} else {
			$this->render('view');
		}

	}

	function view_video($id = null) {

		if (empty($id)) {
			return $this->redirect('/');
		}

		$this->Session->write('current_video_id', $id);

		$total_seconds = 90;

		if ($this->Session->read('user')) {
			$user = $this->Session->read('user');
		} else {
			$user = mt_rand(1000, 9999);
		}

		$ch = curl_init('http://flashaccess2008.micropagos.net:8080/c2enopin/servlet/RequestListener?cid=' . Configure::read('CID') . '&uid=' . $user . '&pool=' . Configure::read('pool') . '&control=' . Configure::read('pass'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$phone = curl_exec($ch);

		$ch = curl_init('http://213.27.137.219:8080/SMSGateway/SmsGateway2FlashIn?cid=' . Configure::read('CID_m') . '&uid=' . $user . '&pool=' . Configure::read('pool_m') . '&control=' . Configure::read('pass_m') . '&peticion=SI');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$mobile = curl_exec($ch);

		$mobile = explode('<SEPARATOR>', $mobile);
		$text = $mobile[0];
		$sms = str_replace('<SENDER>', '', $mobile[1]);

		$this->Session->write('phone', $phone);
		$this->Session->write('text', $text);
		$this->Session->write('sms', $sms);
		$this->Session->write('user', $user);

		$section = 'video';

		if (!$video = $this->Video->findById($id)) {
			$video = $this->Video->findBySlug($id);
		}
		extract($video);

		$title_for_layout = $this->Video->getTitle($Video);

		$this->set(compact('Video', 'section', 'user', 'phone', 'text', 'sms', 'total_seconds', 'title_for_layout'));

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$this->render('/Elements/Videos/video');
		} else {
			$this->render('view');
		}

	}

	function view_photos($id = null, $photo_id = null) {

		if (empty($id)) {
			return $this->redirect('/');
		}

		$section = 'photos';

		if (!$video = $this->Video->findById($id)) {
			$video = $this->Video->findBySlug($id);
		}
		extract($video);

		$title_for_layout = $this->Video->getTitle($Video);

		$this->set(compact('Video', 'section', 'photo_id', 'title_for_layout'));
		
		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$this->render('/Elements/Videos/photos');
		} else {
			$this->render('view');
		}

	}

	function admin_index() {
		
		$videos = $this->Video->find('all');

		$this->set(compact('videos'));

	}

	function admin_edit($id = null) {

		$this->loadModel('VideoRelationship');

		if ($this->request->data) {

			if ($id) {
				$this->Video->id = $id;
			} else {
				$this->Video->create();
			}

			$this->Video->save($this->request->data);

			if (!$id) {
				$id = $this->Video->id;
			}

			if ($categories = $this->request->data['Category']) {
				$this->VideoRelationship->deleteAll(array('video_id' => $id, 'model' => 'Category'));
				foreach ($categories as $key => $value) {
					if ($value) {
						$this->VideoRelationship->create();
						$this->VideoRelationship->save(array(
							'video_id' => $id,
							'model' => 'Category',
							'foreign_id' => $key,
						));
					}
				}
			}

			if ($actors = $this->request->data['Actor']) {
				$this->VideoRelationship->deleteAll(array('video_id' => $id, 'model' => 'Actor'));
				foreach ($actors as $key => $value) {
					if ($value) {
						$this->VideoRelationship->create();
						$this->VideoRelationship->save(array(
							'video_id' => $id,
							'model' => 'Actor',
							'foreign_id' => $key,
						));
					}
				}
			}

			$actors = ClassRegistry::init('VideoRelationship')->getActors($id);
			if (count($actors) > 1) {
				$last = array_pop($actors);
				$layout_title = sprintf(__('%s y %s en %s'), implode(', ', $actors), $last, $this->request->data['Video']['title']);
			} else {
				$layout_title = sprintf(__('%s en %s'), implode(', ', $actors), $Video['title']);
			}

			$this->Video->save(array('slug' => $this->_title2url($layout_title)));


			return $this->redirect('index');

		}
		if ($id) {

			$this->request->data = $this->Video->findById($id);

			$myCat = $this->VideoRelationship->find('all', array(
				'conditions' => array(
					'video_id' => $id,
					'model' => 'Category'
				)
			));
			$myCat = Set::extract('/VideoRelationship/foreign_id', $myCat);

			$myAct = $this->VideoRelationship->find('all', array(
				'conditions' => array(
					'video_id' => $id,
					'model' => 'Actor'
				)
			));
			$myAct = Set::extract('/VideoRelationship/foreign_id', $myAct);

		} else {

			$myAct = $myCat = array();

		}

		$this->loadModel('Category');
		$categories = $this->Category->find('all');

		$this->loadModel('Actor');
		$actors = $this->Actor->find('all');

		$this->set(compact('id', 'categories', 'actors', 'myCat', 'myAct'));

	}

	public function admin_delete($id = null) {
		if ($id) {
			$this->Video->delete($id);
		}
		return $this->redirect('index');
	}

	public function admin_add_file() {
		if (!empty($this->request->data)) {
			if ($this->Video->addFile($this->request->data)) {
				$this->Session->setFlash(__('Video añadido'));
				$this->redirect(array('controller' => 'videos', 'action' => 'edit', $this->Video->id));
			} else {
				$this->Session->setFlash(__('Error al añadir el video')); {	
				$this->redirect(array('controller' => 'archivos', 'action' => 'index'));
			}
		}
		$videos = $this->Video->find('list');
		$this->set(compact('videos'));
		$this->set($this->params['named']);
	}

	function check_phone() {

		$this->layout = false;

		if (is_numeric($this->Session->read('phone'))) {
			$ch = curl_init('http://flashaccess2008.micropagos.net:8080/c2enopin/servlet/Control?cid=' . Configure::read('CID') . '&uid=' . $this->Session->read('user') . '&service=' . $this->Session->read('phone'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			$access = false;
			if (substr($result, 0, 2) === 'OK') {
				$this->Session->write('video_' . $this->Session->read('current_video_id'), date('Y-m-d H:i:s'));
				$access = true;
			}
			$this->set(compact('result', 'access'));
		} else {
			$this->autoRender = false;
		}
	}


	function check_sms() {

		$this->layout = false;

		if (is_numeric($this->Session->read('phone'))) {
			$ch = curl_init('http://213.27.137.219:8080/SMSGateway/SmsGateway2FlashIn?cid=' . Configure::read('CID_m') . '&uid=' . $this->Session->read('user') . '&control=' . Configure::read('pass_m') . '&peticion=NO');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			$access = false;
			if (substr($result, 0, 2) === 'OK') {
				$this->Session->write('video_' . $this->Session->read('current_video_id'), date('Y-m-d H:i:s'));
				$access = true;
			}
			$this->set(compact('result', 'access'));
		} else {
			$this->autoRender = false;
		}
	}

	protected function _title2url($title) {   
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

}
