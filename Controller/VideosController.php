<?php
class VideosController extends AppController {

	function home() {
		
		$videos = $this->Video->find('all');

		$this->set(compact('videos'));

	}

}
