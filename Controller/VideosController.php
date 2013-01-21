<?php
class VideosController extends AppController {

	var $paginate = array();

	function home($page = 1) {

		$ids = $conditions = array();

		foreach ($this->params['named'] as $key => $value) {
			/*
			$this->paginate['Video']['recursive'] = 1;
			$this->paginate['VideoRelationship']['conditions'] = array(
				'model' => 'Category',
				'foreign_id' => $this->params['named']['category']
			);
			*/
			$this->loadModel('VideoRelationship');
			$new_ids = $this->VideoRelationship->find('list', array(
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
		
		$this->paginate['Video']['limit'] = 3;
		$this->paginate['Video']['page'] = $page;

		$videos = $this->paginate($conditions);

		$this->set(compact('videos', 'conditions', 'page'));

	}

	function view($id = null) {

		if (empty($id)) {
			return $this->redirect('/');
		}

		$section = 'trailer';

		extract($this->Video->findById($id));

		$this->set(compact('Video', 'section'));

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

		$total_seconds = 90;

		$user = mt_rand(1000, 9999);

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

		extract($this->Video->findById($id));

		$this->set(compact('Video', 'section', 'user', 'phone', 'text', 'sms', 'total_seconds'));

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
			$this->render('/Elements/Videos/video');
		} else {
			$this->render('view');
		}

	}

	function view_photos($id = null) {

		if (empty($id)) {
			return $this->redirect('/');
		}

		$section = 'photos';

		extract($this->Video->findById($id));

		$photos = array(1, 2, 3, 4, 5);

		$this->set(compact('Video', 'photos', 'section'));
		
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
				$file = $this->request->data['Video']['file'];
			if ($this->request->data['Video']['video_type'] == 0) {
				//Añadir como nuevo video	
				$this->Video->create();
				$this->Video->save(array('title' => $file));
				$id = $this->Video->id;	
			} else {
				$id = $this->request->data['Video']['id'];
			}
			$orig = APP . 'raw' . DS . $file;
			$movie = new ffmpeg_movie($orig);
			if ($this->request->data['Video']['mode'] == 'trailer') {
				$dest = APP . 'uploads' . DS . 'Trailer' . DS . $id;
				$data = array('has_trailer' => 1, 'trailer_duration' => $movie->getDuration());
			} else {
				$dest = APP . 'uploads' . DS . 'Video' . DS . $id;
				$data = array('has_video' => 1, 'duration' => $movie->getDuration());
			}
			exec("mv $orig $dest");			
			$this->Video->id = $id;
			$this->Video->save($data);
			$this->redirect(array('controller' => 'videos', 'action' => 'edit', $id));
		}
		$videos = $this->Video->find('list');
		$this->set(compact('videos'));
		$this->set($this->params['named']);
	}

	function check_phone() {

		if (is_numeric($this->Session->read('phone'))) {
			//$ch = curl_init('http://flashaccess2008.micropagos.net:8080/c2enopin/servlet/Control?cid=' . Configure::read('CID') . '&uid=' . $this->Session->read('user') . '&pool=' . Configure::read('pool') . '&service=' . Configure::read('phone'));
			$ch = curl_init('http://flashaccess.micropagos.net/c2enopin/servlet/Control?cid=' . Configure::read('CID') . '&uid=' . $this->Session->read('user') . '&service=' . $this->Session->read('phone'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			echo $result = curl_exec($ch);
		}

		$this->autoRender = false;
	}


	function check_sms() {

		if (is_numeric($this->Session->read('phone'))) {
			$ch = curl_init('http://213.27.137.219:8080/SMSGateway/SmsGateway2FlashIn?cid=' . Configure::read('CID_m') . '&uid=' . $this->Session->read('user') . '&control=' . Configure::read('pass_m') . '&peticion=NO');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			echo $result = curl_exec($ch);
		}

		$this->autoRender = false;
	}

}
