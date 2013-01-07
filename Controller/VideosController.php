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

		extract($this->Video->findById($id));

		$this->set(compact('Video'));

	}

}
