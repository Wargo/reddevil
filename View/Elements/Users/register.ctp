<?php
echo $this->Form->create('User', array('class' => 'register clearfix', 'url' => array('controller' => 'users', 'action' => 'register')));

echo '<div>';
echo $this->Form->input('username', array(
	'fieldset' => false, 
	'label' => __('Nombre de usuario', true),
));

echo $this->Form->input('password', array(
	'fieldset' => false, 
	'error' => false,
	'label' => __('Contraseña', true),
));

if (!empty($slug)) {
	echo $this->Form->hidden('slug', array('value' => $slug));
}

echo $this->Form->button(__('Registrarse'), array('type'=>'submit'));

echo '</div>';

echo $this->Form->end();
