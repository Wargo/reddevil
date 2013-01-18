<?php
class VideosController extends AppController {

	var $paginate = array();

	function home($page = 1) {
		
		$this->paginate['Video']['limit'] = 3;
		$this->paginate['Video']['page'] = $page;

		$videos = $this->paginate();

		$this->set(compact('videos'));

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

		$user = mt_rand(1000, 9999);

		//$ch = curl_init('http://flashaccess.micropagos.net/c2enopin/servlet/RequestListener?cid=' . Configure::read('CID') . '&uid=' . $user . '&pool=' . Configure::read('pool') . '&control=' . Configure::read('pass'));
		$ch = curl_init('http://flashaccess2008.micropagos.net:8080/c2enopin/servlet/RequestListener?cid=' . Configure::read('CID') . '&uid=' . $user . '&pool=' . Configure::read('pool') . '&control=' . Configure::read('pass'));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$phone = curl_exec($ch);

		$this->Session->write('phone', $phone);
		$this->Session->write('user', $user);

		$section = 'video';

		extract($this->Video->findById($id));

		$this->set(compact('Video', 'section', 'user', 'phone'));

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

		if ($this->request->data) {

			if ($id) {
				$this->Video->id = $id;
			} else {
				$this->Video->create();
			}

			$this->Video->save($this->request->data);

			return $this->redirect('index');

		}

		if ($id) {

			$this->request->data = $this->Video->findById($id);

		}

		$this->set(compact('id'));

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

	function check() {
		if (is_int($this->Session->read('phone'))) {
			$ch = curl_init('http://flashaccess.micropagos.net/c2enopin/servlet/Control?cid=' . Configure::read('CID') . '&uid=' . $this->Session->read('user') . '&service=' . $this->Session->read('phone'));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			echo $result = curl_exec($ch);
		}

		$this->autoRender = false;
	}

}
