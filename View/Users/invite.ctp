<h3><?php echo __('Busca en tus contactos')?></h3>
<?php
$external = '';
if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false) {
	$external = 'external ';
}
echo $this->Form->create('User', array('onsubmit' => 'return confirm(\'' . __('Este proceso puede tardar varios minutos', true) . '\');', 'class' => $external . 'create_form', 'url' => array('controller' => 'users', 'action' => 'find_contacts')));
echo $this->Form->inputs(array(
	'fieldset' => false,
	'email' => array(
		'label' => __('Email o ID', true),
	),
	'pass' => array(
		'label' => __('Contraseña', true),
		'type' => 'password',
	),
	'account' => array(
		'legend' => __('Selecciona la cuenta de la que deseas importar', true),
		'options' => array(
			'hotmail' => $this->Html->image('Msn.png', array('title' => 'Hotmail')),
			//'gmail' => $this->Html->image('Gmail.png', array('title' => 'Gmail')),
			'gmail' => $this->Html->image('Google.png', array('title' => 'Gmail')),
			'yahoo' => $this->Html->image('Yahoo.png', array('title' => 'Yahoo')),
		),
		'value' => 'hotmail',
		'type' => 'radio',
		'div' => 'radio-image radio input'
	)
));
echo $this->Form->submit(__('Buscar', true));
echo $this->Form->end();

echo '<div>';
	echo sprintf(__('O puedes escribir directamente a mano las direcciones de correo a quien quieras enviar la invitación a través de %s', true),
		$this->Html->link(
			__('aquí', true),
			array('controller' => 'users', 'action' => 'send_mails'),
			array('class' => 'dialog_link', 'var' => __('Invitar amigos', true))
		)
	);
echo '</div>';
