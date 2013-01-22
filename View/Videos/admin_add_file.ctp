<?php
echo $this->Form->create('Video');

echo $this->Form->inputs(array(
	'fieldset' => false,
	'file' => array(
		'label' => __('Archivo'),
		'value' => $file,
		'readonly' => true
	),
	'mode' => array(
		'label' => __('Añadir como:'),
		'value' => $mode,
		'type' => 'select',
		'options' => array('trailer' => __('Trailer'), 'video' => __('Vídeo'))
	),
	'video_type' => array(
		'legend' => false,
		'label' => false,
		'type' => 'radio',
		'value' => 0,
		'options' => array(__('Añadir a una nueva escena'), __('Añadir a escena existente'))
	),
	'id' => array(
		'type' => 'select',
		'label' => __('Seleccionar escena'),
		'options' => $videos
	)
));

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'videos', 'action' => 'index'));
