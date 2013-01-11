<?php
class ActorsController extends AppController {

	function admin_index() {
		
		$actors = $this->Actor->find('all');

		$this->set(compact('actors'));

	}

	function admin_edit($id = null) {

		if ($this->request->data) {

			if ($id) {
				$this->Actor->id = $id;
			} else {
				$this->Actor->create();
			}

			$this->Actor->save($this->request->data);

			return $this->redirect('index');

		}

		if ($id) {

			$this->request->data = $this->Actor->findById($id);

		}

		$this->set(compact('id'));

	}

	function admin_delete($id = null) {

		if ($id) {

			$this->Actor->delete($id);

		}

		return $this->redirect('index');

	}

}
