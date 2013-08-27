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
			$title_for_layout = $Actor['name']; //sprintf(__('Vídeos de %s'), $Actor['name']);
			$description_for_layout =  strip_tags($Actor['description']);
			$keywords_for_layout =  $Actor['name'];

			if ($page > 1) {
				$title_for_layout .= ' - ' . $page . 'ª ' . __('página');
			}

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

		// TEMPORAL - no borrar
		if ($id == 'pablo-ferrari-y-samantha-pink-en-samantha-pink') {
			$id = 'pablo-ferrari-y-samantha-pink-en-number-one';
			return $this->redirect(array('controller' => 'videos', 'action' => 'view', $id), 301);
		}
		if ($id == 'pablo-ferrari-y-erica-fontes-en-golosa-busca-polla-sabrosa') {
			$id = 'pablo-ferrari-y-erica-fontes-en-good-morning-erica';
			return $this->redirect(array('controller' => 'videos', 'action' => 'view', $id), 301);
		}

		if ($this->Session->read('Auth.User.caducidad') > date('Y-m-d H:i:s')) {
			if (!$this->params['isAjax']) {
				return $this->redirect(array('controller' => 'videos', 'action' => 'view_video', $id));
			}
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

		if ($id == 'pablo-ferrari-y-samantha-pink-en-samantha-pink') {
			$id = 'pablo-ferrari-y-samantha-pink-en-number-one';
			return $this->redirect(array('controller' => 'videos', 'action' => 'view_video', $id), 301);
		}
		if ($id == 'pablo-ferrari-y-erica-fontes-en-golosa-busca-polla-sabrosa') {
			$id = 'pablo-ferrari-y-erica-fontes-en-good-morning-erica';
			return $this->redirect(array('controller' => 'videos', 'action' => 'view_video', $id), 301);
		}

		$total_seconds = 90;

		$section = 'video';

		if (!$video = $this->Video->findById($id)) {
			$video = $this->Video->findBySlug($id);
		}
		extract($video);

		$this->Session->write('current_video_id', $Video['id']);

		$main = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id' => $Video['id'],
				'main_video' => 1
			),
		));
		if (!$main) {
			$main = ClassRegistry::init('Photo')->find('first', array(
				'conditions' => array(
					'video_id' => $Video['id'],
					'main' => 1
				),
			));
		}

		$title_for_layout = $this->Video->getTitle($Video);

		$this->set(compact('Video', 'main', 'section', 'user', 'phone', 'text', 'sms', 'total_seconds', 'title_for_layout'));

		if ($this->Auth->user('caducidad') > date('Y-m-d H:i:s')) {

			$this->validateAccess();

		}

		if ($Video['site'] == 'glassman') {
			$this->layout = 'glassman';
			return $this->render('glassman');
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

		$conditions = array(
			'active' => 1,
			'published <=' => date('Y-m-d H:i:s'),
			'site' => 'reddevilx',
		);

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
			} elseif (count($actors) == 0) {
				$layout_title = $this->request->data['Video']['title'];
			} else {
				$layout_title = sprintf(__('%s en %s'), implode(', ', $actors), $this->request->data['Video']['title']);
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

		//if (is_numeric($this->Session->read('phone'))) {
			$url = 'http://213.27.137.219:8080/SMSGateway/SmsGateway2FlashIn?cid=' . Configure::read('CID_m') . '&uid=' . $this->Auth->user('id') . '&control=' . Configure::read('pass_m') . '&peticion=NO';
			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			$result = curl_exec($ch);

$file = fopen('sms.txt', 'a');
fwrite($file, "\r\n\r\n");
fwrite($file, "\r\n" . $url . "\r\n");
fwrite($file, "\r\n" . $result . "\r\n");
fwrite($file, "\r\n" . date('Y-m-d H:i:s') . "\r\n");
fwrite($file, "\r\n\r\n");
fclose($file);
			$access = false;
			if (substr($result, 0, 2) === 'OK') {
				$this->loadModel('User');
				$this->User->id = $this->Auth->user('id');
				$date = date('Y-m-d H:i:s', strtotime("+7 day"));
				$this->User->save(array('caducidad' => $date));
				$this->Session->write('Auth.User.caducidad', $date);
				$access = true;
			}
			$this->set(compact('result', 'access'));
		//} else {
			//$this->autoRender = false;
		//}
	}

	function validateAccess() {

		exec('mkdir links/' . $this->Auth->user('id'));

		//$current = $this->Session->read('current_video_id');

		$videos = $this->Video->find('all');

		foreach ($videos as $video) {

			$current = $video['Video']['id'];
		
			$link = Security::hash($this->Auth->user('id') . '_' . $current, null, true);

			$formats = Configure::read('formats');

			exec('ln -s ../../../uploads/Video/mp4/l/' . $current . '.mp4 links/' . $this->Auth->user('id') . '/' . $link . '_mp4_l.mp4');
			foreach ($formats as $format) {
				foreach ($format['sizes'] as $size) {
					exec('ln -s ../../../uploads/Video/' . $format['folder'] . '/' . $size . '/' . $current . '.' . $format['folder'] . ' links/' . $this->Auth->user('id') . '/' . $link . '_' . $format['folder'] . '_' . $size . '.' . $format['folder']);
				}
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

	function whatsapp($id = null) {

		if (!$id) {
			return $this->redirect('home');
		}

		$dir = WWW_ROOT . 'pills' . DS . $id;

		$videos = scandir($dir);

		$this->set(compact('videos', 'id'));

	}

}
