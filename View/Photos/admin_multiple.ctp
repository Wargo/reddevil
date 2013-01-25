<?php
echo $this->Form->create('Photo', array('url' => array('admin' => true, 'controller' => 'photos', 'action' => 'multiple')));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'num' => array(
		'label' => __('Cuántas?'),
	),
	'video_id' => array(
		'label' => __('Vídeo'),
		'options' => $videos,
		'empty' => __('Ningún vídeo')
	),
));

echo $this->Form->submit(__('Crear'));
echo $this->Form->end();
