<?php
echo $this->Form->create('Video', array('controller' => 'categories', 'action' => 'edit', $id));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'title' => array(
		'label' => __('Título', true),
	),
	'description' => array(
		'label' => __('Descripción', true),
	),
));

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'videos', 'action' => 'index'));
