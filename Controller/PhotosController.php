<?php
class PhotosController extends AppController {

	var $paginate = array();

	function index() {

		if (!empty($this->params['page'])) {
			$page = $this->params['page'];
		} else {
			$page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : 1;
		}
		
		$this->loadModel('Video');

		list($conditions, $pageCount, $videos) = $this->Video->getVideos($page, array(), 10);

		$title_for_layout = __('Fotos');

		$this->set(compact('videos', 'conditions', 'page', 'pageCount', 'title_for_layout'));

	}

	function view() {
		if (!$this->params['actor']) {
			return $this->redirect('/');
		}

		extract(ClassRegistry::init('Actor')->findBySlug($this->params['actor']));

		$this->loadModel('PhotoRelationship');
		$ids = $this->PhotoRelationship->find('list', array(
			'conditions' => array(
				'foreign_id' => $Actor['id'],
				'model' => 'Actor',
			),
			'fields' => array('photo_id'),
		));

		if (!empty($this->params['page'])) {
			$page = $this->params['page'];
		} else {
			$page = !empty($this->params['named']['page']) ? $this->params['named']['page'] : 1;
		}
		
		$this->paginate['limit'] = 12;
		$this->paginate['page'] = $page;
		$photos = $this->paginate('Photo', array('Photo.id' => $ids, 'Photo.active' => 1));

		$this->set(compact('photos', 'Actor', 'page'));
	}

	function admin_index() {
		
		$photos = $this->Photo->find('all');

		$this->set(compact('photos'));

	}

	function admin_multiple() {
		
		$this->layout = false;

		if (!empty($this->request->data['Photo']['num'])) {
			
			for ($i = 0; $i < $this->request->data['Photo']['num']; $i ++) {
				$this->Photo->create();
				$this->Photo->save(array(
					'title' => 'Foto ' . ($i + 1),
					'video_id' => $this->request->data['Photo']['video_id']
				));
			}
			return $this->redirect(array('admin' => true, 'controller' => 'photos', 'action' => 'index'));

		} else {

			$this->loadModel('Video');
			$videos = $this->Video->find('list', array(
				'fields' => array('id', 'title')
			));
			$this->set(compact('videos'));

		}

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
