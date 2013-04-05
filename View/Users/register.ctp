<?php
echo $this->Form->create('User', array('class' => 'register clearfix'));

echo $this->Form->input('username', array(
	'fieldset' => false, 
	'label' => __('Nombre de usuario', true),
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

echo $this->Form->radio('option', array(0 => 'SMS', 1 => 'Tarjeta de crédito'), array('legend' => __('Forma de pago')));

echo $this->Form->button(__('Registrarse'), array('type'=>'submit'));

echo $this->Form->end();
