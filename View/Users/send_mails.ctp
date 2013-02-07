<?php
MiCache::$section = $login['id'];
$name = MiCache::data($login['model'], 'field', 'name', array('id' => $login['id']));
echo $this->Form->create('Message', array('class' => 'create_form ajax_validate close', 'url' => array('controller' => 'users', 'action' => 'send_mails')));
echo $this->Form->inputs(array(
	'fieldset' => false,
	/*
	'message' => array(
		'type' => 'textarea',
		'label' => __('Mensaje', true),
		//'value' => sprintf(__('Hola! %s te invita a participar en Interconnecting Sports', true), $name),
		'value' => sprintf(__('Hola! %s te invita a formar parte de la comunidad de deportistas de tu municipio', true), $name),
	), */
	'emails' => array(
		'type' => 'textarea',
		'label' => __('Destinatarios', true),
		'after' => '<br />' . __('Puedes añadir más emails separándolos por comas', true),
		'value' => !empty($emails)?$emails:null,
		'rows' => 3,
		'class' => 'validate',
	),
/*
	'relation' => array(
		'type' => 'checkbox',
		'label' => __('Generar peticiones', true),
		'after' => ' <span class="tooltip" title="' . __('Generará la relación de amistad/socio en cuanto los usuarios destinatarios se registren en Interconnecting Sports', true) . '">?</span>',
	),
*/
));
echo $this->Form->submit(__('Enviar emails', true), array('class' => 'button_blue'));
echo $this->Form->end();
