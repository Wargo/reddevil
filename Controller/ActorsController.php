<?php
class ActorsController extends AppController {

	function index() {
	
		$actors = $this->Actor->find('all', array(
			'conditions' => array(
				//'active' => 1
			),
		));

		$title_for_layout = __('Actores y actrices de RedDevilX');

		$names = Set::extract('/Actor/name', $actors);

		$description_for_layout = implode(', ', $names);

		$this->set(compact('actors', 'title_for_layout', 'description_for_layout'));
		
	}

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

			$this->request->data['Actor']['slug'] = ClassRegistry::init('Video')->title2url($this->request->data['Actor']['name']);

			$this->Actor->save($this->request->data);

			if (!empty($_FILES['data']['name']['Actor']['file'])) {
				$aux = explode('-', $this->Actor->id);
				$aux = substr($aux[1], 0, 3);
				if (!is_dir(APP . 'uploads' . DS . 'img' . DS . 'Actor' . DS . $aux)) {
					mkdir(APP . 'uploads' . DS . 'img' . DS . 'Actor' . DS . $aux);
				}
				exec('rm -f ' . WWW_ROOT . 'img' . DS . 'Actor' . DS . $aux . DS . $this->Actor->id . '*');
				move_uploaded_file($_FILES['data']['tmp_name']['Actor']['file'],
					APP . 'uploads' . DS . 'img' . DS . 'Actor' . DS . $aux . DS . $this->Actor->id . '.jpg');
			}

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
