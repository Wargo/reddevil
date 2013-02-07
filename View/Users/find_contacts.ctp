<?php
echo $this->Form->create('Email', array('class' => 'create_form', 'url' => array('controller' => 'users', 'action' => 'send_mails')));
if(empty($lista)) {
	echo '<p>' . __('Ha ocurrido un error en la importación de contactos', true) . '</p>';
	echo $this->Html->link(__('Volver', true), array('controller' => 'users', 'action' => 'invite'), array('class' => 'dialog_link', 'var' => __('Buscar Amigos', true)));
} else {
	echo $this->Form->inputs(array(
		'fieldset' => false,
		'email' => array(
			'label' => __('Seleccionar todos', true),
			'class' => 'select_all',
			'type' => 'checkbox',
		),
	));
	$i = 0;
	foreach($lista as $email) {
		if(MiCache::data('User', 'find', 'count', array('conditions' => array('email' => $email)))) {
			$disabled = 'input checkbox checkbox_disabled';
		} else {
			$disabled = 'input checkbox';
		}
		echo $this->Form->inputs(array(
			'fieldset' => false,
			'email_' . $i => array(
				'label' => $email,
				'value' => $email,
				'type' => 'checkbox',
				'class' => 'email',
				'div' => $disabled,
			),
		));
		$i ++;
	}
	echo $this->Form->submit(__('Seleccionar', true), array('class' => 'button_blue'));
}
echo $this->Form->end();
