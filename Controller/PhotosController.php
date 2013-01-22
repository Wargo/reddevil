<?php
class PhotosController extends AppController {

	function index($page = 1) {
		
		$this->loadModel('Video');

		list($conditions, $pageCount, $videos) = $this->Video->getVideos($page, 3, $this->params['named']);

		$this->set(compact('videos', 'conditions', 'page', 'pageCount'));

	}

	function admin_index() {
		
		$photos = $this->Photo->find('all');

		$this->set(compact('photos'));

	}

	function admin_edit($id = null) {

		$this->loadModel('PhotoRelationship');

		if ($this->request->data) {

			if ($id) {
				$this->Photo->id = $id;
			} else {
				$this->Photo->create();
			}

			if (empty($this->request->data['Photo']['video_id'])) {
				$this->request->data['Photo']['video_id'] = null;
			}

			$this->Photo->save($this->request->data);

			if (!$id) {
				$id = $this->Photo->id;
			}

			if ($categories = $this->request->data['Category']) {
				$this->PhotoRelationship->deleteAll(array('photo_id' => $id, 'model' => 'Category'));
				foreach ($categories as $key => $value) {
					if ($value) {
						$this->PhotoRelationship->create();
						$this->PhotoRelationship->save(array(
							'photo_id' => $id,
							'model' => 'Category',
							'foreign_id' => $key,
						));
					}
				}
			}

			if ($actors = $this->request->data['Actor']) {
				$this->PhotoRelationship->deleteAll(array('photo_id' => $id, 'model' => 'Actor'));
				foreach ($actors as $key => $value) {
					if ($value) {
						$this->PhotoRelationship->create();
						$this->PhotoRelationship->save(array(
							'photo_id' => $id,
							'model' => 'Actor',
							'foreign_id' => $key,
						));
					}
				}
			}

			return $this->redirect('index');

		}

		if ($id) {

			$this->request->data = $this->Photo->findById($id);

			$myCat = $this->PhotoRelationship->find('all', array(
				'conditions' => array(
					'photo_id' => $id,
					'model' => 'Category'
				)
			));
			$myCat = Set::extract('/PhotoRelationship/foreign_id', $myCat);

			$myAct = $this->PhotoRelationship->find('all', array(
				'conditions' => array(
					'photo_id' => $id,
					'model' => 'Actor'
				)
			));
			$myAct = Set::extract('/PhotoRelationship/foreign_id', $myAct);

		} else {

			$myAct = $myCat = array();

		}

		$this->loadModel('Category');
		$categories = $this->Category->find('all');

		$this->loadModel('Actor');
		$actors = $this->Actor->find('all');

		$this->loadModel('Video');
		$videos = $this->Video->find('list', array(
			'fields' => array('id', 'title'),
		));

		$this->set(compact('id', 'categories', 'actors', 'videos', 'myCat', 'myAct'));

	}

	function admin_delete($id = null) {

		if ($id) {

			$this->Photo->delete($id);

		}

		return $this->redirect('index');

	}

}
