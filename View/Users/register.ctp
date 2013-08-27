<div class="clearfix">
<?php
echo $this->Html->image('bg/fallera.png', array('align' => 'left', 'width' => 576));

echo '<div style="float:right; width:380px; margin-right:0px;">';

	echo '<h1>' . __('Login') . '</h1>';
	echo '<p>' . __('Accede para ver a todos los vídeos privados') . '</p>';

	echo $this->Form->create('User', array('class' => 'register clearfix', 'style' => 'background-color:#DDD', 'url' => array('controller' => 'users', 'action' => 'login')));

	echo $this->Form->input('username', array(
		'fieldset' => false, 
		'label' => __('Nombre de usuario', true),
	));

	echo $this->Form->input('password', array(
		'fieldset' => false, 
		'type' => 'password',
		'label' => __('Contraseña', true),
	));

	if (!empty($slug)) {
		echo $this->Form->hidden('slug', array('value' => $slug));
	}

	echo $this->Form->submit(__('Acceder'));
	echo $this->Form->end();

	echo '<h1>' . __('Registro') . '</h1>';
	echo '<p>' . __('Regístrate y obtén acceso a todos los vídeos privados') . '</p>';

	echo $this->Form->create('User', array('class' => 'register clearfix', 'style' => 'background-color:#DDD'));

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

	//echo $this->Form->radio('option', array(0 => 'SMS', 1 => 'Tarjeta de crédito'), array('legend' => __('Forma de pago')));
	$this->request->data['User']['option'] = 0;
	echo $this->Form->inputs(array(
		'fieldset' => false,
		'option' => array(
			'legend' => __('Forma de pago'),
			'options' => array(
				0 => 'SMS',
				1 => __('Tarjeta de crédito'),
			),
			'type' => 'radio',
		)
	));

	if (!empty($slug)) {
		echo $this->Form->hidden('slug', array('value' => $slug));
	}

	echo $this->Form->submit(__('Registrarse'));

	echo $this->Form->end();

echo '</div>';
?>
</div>
