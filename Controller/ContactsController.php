<?php
class ContactsController extends AppController {

	function beforeFilter() {
		if(in_array($this->params['action'], array('feedback'))) {
			$this->Security->validatePost = false;
			$this->Security->csrfCheck = false;
		}
		return parent::beforeFilter();
	}

	function contact() {

		if ($this->request->data) {

			extract($this->request->data['Contact']);

			$must = array('name', 'age', 'country', 'email');

			$errors = array();

			foreach ($must as $field) {

				if (empty(${$field})) {
					$errors[] = $field;
				}

			}

			if (count($errors)) {
				$this->Session->setFlash(__('Ha ocurrido un error, revisa todos los datos'), 'default', array('class' => 'error'));
				$this->set(compact('errors'));
				return $this->render('/Pages/wannabe');
			}

			$this->Contact->create();
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('Formulario enviado correctamente'), 'default', array('class' => 'notification'));
				$this->request->data = null;
			} else {
				$this->Session->setFlash(__('Ha ocurrido un error, revisa todos los datos'), 'default', array('class' => 'error'));
			}

		}

		$this->render('/Pages/wannabe');

	}

	function feedback() {

		if ($this->request->is('ajax')) {
			$this->layout = 'ajax';
		}

		if ($this->request->data) {

			$this->Contact->create();

			$this->request->data['Contact']['type'] = 'feedback';

			$this->Contact->save($this->request->data);

			if (!$this->request->is('ajax')) {
				return $this->redirect('/');
			}

		}

		if (!$this->request->is('ajax')) {
			$this->render('/Pages/feedback');
		} else {
			$this->autoRender = false;
		}

	}

	function admin_index() {

		$contacts = $this->Contact->find('all', array('order' => array('created' => 'desc')));

		$this->set(compact('contacts'));

	}

}
