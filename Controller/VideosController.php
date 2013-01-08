<?php
class VideosController extends AppController {

	function home() {
		
		$videos = $this->Video->find('all');

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

}
