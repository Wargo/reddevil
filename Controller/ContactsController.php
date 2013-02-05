<?php
class ContactsController extends AppController {

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
			} else {
				$this->Session->setFlash(__('Ha ocurrido un error, revisa todos los datos'), 'default', array('class' => 'error'));
			}

		}

		$this->render('/Pages/wannabe');

	}

}
