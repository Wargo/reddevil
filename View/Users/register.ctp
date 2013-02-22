<?php
echo $this->Form->create('User', array('class' => 'register clearfix'));

echo $this->Form->input('first_name', array(
	'fieldset' => false, 

	'label' => __('Nombre', true),
));

echo $this->Form->input('last_name', array(
	'fieldset' => false, 

	'label' => __('Apellidos', true),
));

echo $this->Form->input('email', array(
	'fieldset' => false, 

	'label' => __('Email', true),
));

echo $this->Form->input('password', array(
	'fieldset' => false, 

	'error' => false,
	'label' => __('Contraseña', true),
));

echo $this->Form->input('confirm', array(
	'fieldset' => false, 

	'type' => 'password',
	'label' => __('Repetir contraseña', true),
));
echo $this->Form->error('password');

echo $this->Form->button(__('Registrarse'), array('type'=>'submit'));

echo $this->Form->end();
