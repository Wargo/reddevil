<?php
echo $this->Form->create('Category', array('controller' => 'categories', 'action' => 'edit', $id));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'name' => array(
		'label' => __('Nombre', true),
	),
	'description' => array(
		'label' => __('Descripción', true),
	),
));

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'categories', 'action' => 'index'));
