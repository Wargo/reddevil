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

$c_fields = array('fieldset' => false);
foreach ($categories as $category) {

	extract($category);

	$c_fields['Category.' . $Category['id']] = array(
		'type' => 'checkbox',
		'label' => $Category['name'],
		'div' => 'input checkbox left',
	);

	if (in_array($Category['id'], $myCat)) {
		$c_fields['Category.' . $Category['id']]['checked'] = true; 
	}

}

$a_fields = array('fieldset' => false);
foreach ($actors as $actor) {

	extract($actor);

	$a_fields['Actor.' . $Actor['id']] = array(
		'type' => 'checkbox',
		'label' => $Actor['name'],
		'div' => 'input checkbox left',
	);

	if (in_array($Actor['id'], $myAct)) {
		$a_fields['Actor.' . $Actor['id']]['checked'] = true; 
	}

}

echo '<div>';
	echo '<label>' . __('Categorías', true) . '</label>';
	echo $this->Form->inputs(
		$c_fields
	);
echo '</div>';

echo '<div>';
	echo '<label>' . __('Actores/actrices', true) . '</label>';
	echo $this->Form->inputs(
		$a_fields
	);
echo '</div>';

if ($this->request->data['Video']['has_trailer']) {
	echo $this->element('Videos/admin_brief', array('mode' => 'trailer', 'data' => $this->request->data));
}

if ($this->request->data['Video']['has_video']) {	
	echo $this->element('Videos/admin_brief', array('mode' => 'video', 'data' => $this->request->data));
}

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'videos', 'action' => 'index'));
