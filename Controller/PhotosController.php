<?php
class PhotosController extends AppController {

	function admin_index() {
		
		$photos = $this->Photo->find('all');

		$this->set(compact('photos'));

	}

	function admin_edit($id = null) {

		if ($this->request->data) {

			if ($id) {
				$this->Photo->id = $id;
			} else {
				$this->Photo->create();
			}

			$this->Photo->save($this->request->data);

			return $this->redirect('index');

		}

		if ($id) {

			$this->request->data = $this->Photo->findById($id);

		}

		$this->set(compact('id'));

	}

	function admin_delete($id = null) {

		if ($id) {

			$this->Photo->delete($id);

		}

		return $this->redirect('index');

	}

}
