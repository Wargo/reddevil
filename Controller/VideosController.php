<?php
class VideosController extends AppController {

	var $paginate = array();

	function beforeFilter() {
		parent::beforeFilter();
		$cookies = $this->Cookie->read();
		$this->set(compact('cookies'));
	}

	function home() {

		if (!empty($this->params['page'])) {
			$page = $this->params['page'];
		} else {
			$page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : 1;
		}

		$params = array(
			'actor' => $this->params['actor'],
			'category' => $this->params['category'],
		);

		if ($params['actor']) {
			extract(ClassRegistry::init('Actor')->find('first', array(
				'conditions' => array(
					'slug' => $params['actor']
				)
			)));
			$title_for_layout = sprintf(__('Vídeos de %s'), $Actor['name']);
			$description_for_layout =  $Actor['description'];
			$keywords_for_layout =  $Actor['name'];
			$this->set(compact('description_for_layout', 'keywords_for_layout'));
		} elseif ($params['category']) {
			$title_for_layout = sprintf(__('Vídeos sobre %s'), ClassRegistry::init('Category')->field('name', array(
				'slug' => $params['category']
			)));
		} else {
			$title_for_layout = __('Videos Reddevilx');
		}

		list($conditions, $pageCount, $videos) = $this->Video->getVideos($page, $params);

		$this->set(compact('videos', 'conditions', 'page', 'pageCount', 'title_for_layout'));

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
		$description_for_layout = $keywords_for_layout = $Video['description'];

		$main = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id' => $Video['id'],
				'main' => 1
			),
		));

		$this->set(compact('Video', 'main', 'section', 'layout_title', 'title_for_layout', 'description_for_layout', 'keywords_for_layout'));

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

		$this->loadModel('User');

		if ($this->Cookie->read('user')) {
			$user = $this->Cookie->read('user');
			if (!$this->Auth->user('id')) {
				$this->Auth->login($this->User->findById($user));
			}
		} else {
			$user = mt_rand(1000000, 9999999);
			//$this->User->register(array(
			$this->User->Behaviors->detach('UserAccount');
			$this->User->create();

			$user_data = array(
				'group' => 'guest',
				'email' => $user . '@guest.com',
				'password' => $user,
				'confirm' => $user,
				'active' => 0,
				'username' => $user,
				'first_name' => $user,
				'last_name' => $user,
				'ip' => $_SERVER['REMOTE_ADDR'],
				'last_active' => date('Y-m-d H:i:s'),
			);
			$this->User->save($user_data);

			$user = $this->User->id;
			$this->Cookie->write('user', $user);

			$aux = $this->User->findById($user);
			$this->Auth->login($aux['User']);
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

		$section = 'video';

		if (!$video = $this->Video->findById($id)) {
			$video = $this->Video->findBySlug($id);
		}
		extract($video);

		$this->Session->write('current_video_id', $Video['id']);

		$main = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id' => $Video['id'],
				'main' => 1
			),
		));

		$title_for_layout = $this->Video->getTitle($Video);

		$this->set(compact('Video', 'main', 'section', 'user', 'phone', 'text', 'sms', 'total_seconds', 'title_for_layout'));

		if ($this->Cookie->read('video_' . $Video['id']) > date('Y-m-d H:i:s', strtotime("-1 day"))) {

			$this->validateAccess();

		}

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

	function search() {

		if ($this->request->data) {
			return $this->redirect(array(
				'controller' => 'videos', 'action' => 'search', 'search' => $this->request->data['Video']['search'], 'page' => 1
			));
		}
		
		$search = $this->params['search'];

		$this->request->data['Video']['search'] = $search;

		if (!empty($this->params['page'])) {
			$page = $this->params['page'];
		} else {
			$page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : 1;
		}

		$conditions['or'] = array(
			'title like' => '%' . $search . '%',
			'description like' => '%' . $search . '%',
		);

		$this->paginate['limit'] = 3;
		$this->paginate['page'] = $page;

		$videos = $this->paginate('Video', $conditions);

		$pageCount = $this->params['paging']['Video']['pageCount'];

		$title_for_layout = sprintf(__('Buscando %s en RedDevilX'), $search);

		$this->set(compact('videos', 'conditions', 'page', 'pageCount', 'title_for_layout'));

		$this->render('home');

	}

	function admin_index() {
		
		$videos = $this->Video->find('all', array('order' => array('published' => 'desc')));

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

			$all_actors = ClassRegistry::init('VideoRelationship')->getActors($id);
			$actors = Set::extract('/Actor/slug', $all_actors);
			if (count($actors) > 1) {
				$last = array_pop($actors);
				$layout_title = sprintf(__('%s y %s en %s'), implode(', ', $actors), $last, $this->request->data['Video']['title']);
			} else {
				$layout_title = sprintf(__('%s en %s'), implode(', ', $actors), $Video['title']);
			}

			$categories = ClassRegistry::init('VideoRelationship')->getCategories($id);
			$all_actors = Set::extract('/Actor/name', $all_actors);

			$this->Video->save(array(
				'slug' => $this->Video->title2url($layout_title),
				'description' => implode(' ', $all_actors) . ' ' . implode(' ', $categories)
			));


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
				$this->Session->setFlash(__('Error al añadir el video')); 	
				$this->redirect(array('controller' => 'archivos', 'action' => 'index'));
			}
		}
		$videos = $this->Video->find('list');
		$this->set(compact('videos'));
		$this->set($this->params['named']);
	}

	function check_phone() {

		$this->layout = 'ajax';

		if (is_numeric($this->Session->read('phone'))) {
			$ch = curl_init('http://flashaccess2008.micropagos.net:8080/c2enopin/servlet/Control?cid=' . Configure::read('CID') . '&uid=' . $this->Cookie->read('user') . '&service=' . $this->Session->read('phone'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			$access = false;
			//if (Configure::read('debug') || substr($result, 0, 2) === 'OK') {
			if (substr($result, 0, 2) === 'OK') {
				//$this->validateAccess();
				$current = $this->Session->read('current_video_id');
				$this->Cookie->write('video_' . $current, date('Y-m-d H:i:s'));
				$access = true;
			}
			$this->set(compact('result', 'access'));
		} else {
			$this->autoRender = false;
		}
	}

	function check_sms() {

		$this->layout = 'ajax';

		if (is_numeric($this->Session->read('phone'))) {
			$ch = curl_init('http://213.27.137.219:8080/SMSGateway/SmsGateway2FlashIn?cid=' . Configure::read('CID_m') . '&uid=' . $this->Cookie->read('user') . '&control=' . Configure::read('pass_m') . '&peticion=NO');
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);
			$access = false;
			if (substr($result, 0, 2) === 'OK') {
				//$this->validateAccess();
				$current = $this->Session->read('current_video_id');
				$this->Cookie->write('video_' . $current, date('Y-m-d H:i:s'));
				$access = true;
			}
			$this->set(compact('result', 'access'));
		} else {
			$this->autoRender = false;
		}
	}

	function validateAccess() {

		exec('mkdir links/' . $this->Cookie->read('user'));

		$current = $this->Session->read('current_video_id');
		//$this->Cookie->write('video_' . $current, date('Y-m-d H:i:s'));
		
		$link = Security::hash($this->Cookie->read('user') . '_' . $current, null, true);

		$formats = Configure::read('formats');

		exec('ln -s ../../../uploads/Video/mp4/l/' . $current . '.mp4 links/' . $this->Cookie->read('user') . '/' . $link . '_mp4_l.mp4');
		foreach ($formats as $format) {
			foreach ($format['sizes'] as $size) {
				exec('ln -s ../../../uploads/Video/' . $format['folder'] . '/' . $size . '/' . $current . '.' . $format['folder'] . ' links/' . $this->Cookie->read('user') . '/' . $link . '_' . $format['folder'] . '_' . $size . '.' . $format['folder']);
			}
		}
	}

	function download($id = null) {

		$this->layout = 'ajax';

		if (!$id) {
			return false;
		}
		extract($this->Video->find('first', array(
			'conditions' => array(
				'id' => $id,
				'Video.active' => 1,
			),
		)));

		$this->set(compact('Video'));
	}

	function share($id = null) {

		$this->layout = 'ajax';

		if (!$id) {
			return false;
		}
		extract($this->Video->find('first', array(
			'conditions' => array(
				'id' => $id,
				'Video.active' => 1,
			),
		)));

		$this->set(compact('Video'));
	}

	function formats($id = null, $type = null) {

		$this->layout = 'ajax';

		if (!$id || !$type) {
			return false;
		}

		extract($this->Video->findById($id));
		
		$this->set(compact('Video', 'type'));
	}

	function external($id = null) {

		$this->layout = 'external';

		if (!$id) {
			return false;
		}

		extract($this->Video->findById($id));

		$main = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id' => $Video['id'],
				'main' => 1
			),
		));
		$this->set(compact('Video', 'main'));

	}

	function sitemap() {
		$this->Video->generateSitemap();
		$this->autoRender = false;
	}

}
