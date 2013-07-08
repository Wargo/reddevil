<?php
class WallpapersController extends AppController {

	function admin_index() {
		
		$wallpapers = $this->Wallpaper->find('all');

		$this->set(compact('wallpapers'));

	}

	function admin_edit($id = null) {

		if ($this->request->data) {

			if ($id) {
				$this->Wallpaper->id = $id;
			} else {
				$this->Wallpaper->create();
			}

			$avatar = (!empty($this->request->data['Wallpaper']['avatar']))?$this->request->data['Wallpaper']['avatar']:'placeholder';

			if (!empty($_FILES['data']['name']['Wallpaper']['file'])) {
				if ($avatar == 'placeholder') {
					$avatar = String::uuid();
					$this->request->data['Wallpaper']['avatar'] = $avatar;
				}
				$aux = explode('-', $avatar);
				$aux = substr($aux[1], 0, 3);
				if (!is_dir(APP . 'uploads' . DS . 'img' . DS . 'Wallpaper' . DS . $aux)) {
					mkdir(APP . 'uploads' . DS . 'img' . DS . 'Wallpaper' . DS . $aux);
				}
				exec('rm -f ' . WWW_ROOT . 'img' . DS . 'Wallpaper' . DS . $aux . DS . $avatar . '*');
				move_uploaded_file($_FILES['data']['tmp_name']['Wallpaper']['file'],
					APP . 'uploads' . DS . 'img' . DS . 'Wallpaper' . DS . $aux . DS . $avatar . '.jpg');
			}

			if (!empty($_FILES['data']['name']['Wallpaper']['file2'])) {
				if ($avatar == 'placeholder') {
					$avatar = String::uuid();
					$this->request->data['Wallpaper']['avatar'] = $avatar;
				}
				$aux = explode('-', $avatar);
				$aux = substr($aux[1], 0, 3);
				if (!is_dir(APP . 'uploads' . DS . 'img' . DS . 'Wallpaper2' . DS . $aux)) {
					mkdir(APP . 'uploads' . DS . 'img' . DS . 'Wallpaper2' . DS . $aux);
				}
				exec('rm -f ' . WWW_ROOT . 'img' . DS . 'Wallpaper2' . DS . $aux . DS . $avatar . '*');
				move_uploaded_file($_FILES['data']['tmp_name']['Wallpaper']['file2'],
					APP . 'uploads' . DS . 'img' . DS . 'Wallpaper2' . DS . $aux . DS . $avatar . '.jpg');
			}

			if (!empty($_FILES['data']['name']['Wallpaper']['file3'])) {
				if ($avatar == 'placeholder') {
					$avatar = String::uuid();
					$this->request->data['Wallpaper']['avatar'] = $avatar;
				}
				$aux = explode('-', $avatar);
				$aux = substr($aux[1], 0, 3);
				if (!is_dir(APP . 'uploads' . DS . 'img' . DS . 'bg' . DS . $aux)) {
					mkdir(APP . 'uploads' . DS . 'img' . DS . 'bg' . DS . $aux);
				}
				exec('rm -f ' . WWW_ROOT . 'img' . DS . 'bg' . DS . $aux . DS . $avatar . '*');
				move_uploaded_file($_FILES['data']['tmp_name']['Wallpaper']['file3'],
					APP . 'uploads' . DS . 'img' . DS . 'bg' . DS . $aux . DS . $avatar . '.jpg');
			}
			
			$this->Wallpaper->save($this->request->data);
			return $this->redirect(array('action' => 'index'));

		}

		if ($id) {

			$this->request->data = $this->Wallpaper->findById($id);

		}

		$this->loadModel('Video');
		$conditions = array('active' => 1);
		$order = array('title' => 'asc');
		$videos = $this->Video->find('list', compact('order', 'conditions'));

		$this->set(compact('id', 'videos'));

	}

	function admin_delete($id = null) {

		if ($id) {

			$this->Wallpaper->delete($id);

		}

		return $this->redirect('index');

	}

	function admin_active($id) {
		$this->Wallpaper->updateAll(array('active' => 0));
		$this->Wallpaper->id = $id;
		$this->Wallpaper->save(array('active' => 1));
		return $this->redirect(array('action' => 'index'));
	}

}
