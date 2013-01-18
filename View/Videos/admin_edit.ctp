<?php
echo $this->Form->create('Video', array('controller' => 'categories', 'action' => 'edit', $id));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'title' => array(
		'label' => __('Título'),
	),
	'description' => array(
		'label' => __('Descripción'),
	),
	'active' => array(
		'label' => __('Publicado')
	)
));

if ($this->request->data['Video']['has_trailer']) {
	echo $this->element('Videos/admin_brief', array('mode' => 'trailer', 'data' => $this->request->data));
}

if ($this->request->data['Video']['has_video']) {	
	echo $this->element('Video/admin_brief', array('mode' => 'trailer', 'data' => $this->request->data));
}

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'videos', 'action' => 'index'));
