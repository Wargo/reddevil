<?php
class CategoriesController extends AppController {

	function admin_index() {
		
		$categories = $this->Category->find('all');

		$this->set(compact('categories'));

	}

	function admin_edit($id = null) {

		if ($this->request->data) {

			if ($id) {
				$this->Category->id = $id;
			} else {
				$this->Category->create();
			}

			$this->request->data['Category']['slug'] = ClassRegistry::init('Video')->title2url($this->request->data['Category']['name']);

			$this->Category->save($this->request->data);

			return $this->redirect('index');

		}

		if ($id) {

			$this->request->data = $this->Category->findById($id);

		}

		$this->set(compact('id'));

	}

	function admin_delete($id = null) {

		if ($id) {

			$this->Category->delete($id);

		}

		return $this->redirect('index');

	}

}
