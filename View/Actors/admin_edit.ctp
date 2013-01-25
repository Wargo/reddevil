<?php
echo $this->Form->create('Actor', array('type' => 'file', 'url' => array('controller' => 'actors', 'action' => 'edit', $id)));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'name' => array(
		'label' => __('Nombre'),
	),
	'description' => array(
		'label' => __('Descripción'),
	),
	'file' => array(
		'label' => __('Foto principal'),
		'type' => 'file',
		'after' => $this->Html->image('Actor/' . $id . '.jpg', array('width' => 300))
	),
));

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'actors', 'action' => 'index'));
