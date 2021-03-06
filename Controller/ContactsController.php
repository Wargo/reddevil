<?php
class ContactsController extends AppController {

	function beforeFilter() {
		if(in_array($this->params['action'], array('feedback'))) {
			$this->Security->validatePost = false;
			$this->Security->csrfCheck = false;
		}
		return parent::beforeFilter();
	}

	function webmaster() {

		if ($this->request->data) {

			extract($this->request->data['Contact']);

			$must = array('name', 'email');

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

			$this->request->data['Contact']['type'] = 'webmaster';
			$this->request->data['Contact']['ip'] = $_SERVER['REMOTE_ADDR'];

			$this->Contact->create();
			if ($this->Contact->save($this->request->data)) {
				$this->Session->setFlash(__('Formulario enviado correctamente'), 'default', array('class' => 'notification'));
				$this->request->data = null;
			} else {
				$this->Session->setFlash(__('Ha ocurrido un error, revisa todos los datos'), 'default', array('class' => 'error'));
			}

		}

		$this->render('/Pages/webmaster');

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

			$this->request->data['Contact']['ip'] = $_SERVER['REMOTE_ADDR'];

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
			$this->request->data['Contact']['ip'] = $_SERVER['REMOTE_ADDR'];

			$this->request->data['Contact']['country'] = $_SERVER['HTTP_USER_AGENT'];
			$this->request->data['Contact']['name'] = $this->Auth->user('id');

			$this->Contact->save($this->request->data);

			// Load model MiEmail y send_mail
			$this->loadModel('MiEmail');
			$data = array(
				'to' => 'guillermo@artvisual.net',
				'subject' => __('Contacto desde la web'),
				'data' => $this->request->data,
				'template' => 'contact',
				'from' => 'noreply@reddevilx.com',
				'from_user_id' => $this->Auth->user('id'),
				'to_user_id' => $this->Auth->user('id'),
				'type' => 'private',
			);
			$this->MiEmail->create();
			$this->MiEmail->send($data);

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
