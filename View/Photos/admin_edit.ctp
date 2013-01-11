<?php
echo $this->Form->create('Photo', array('controller' => 'categories', 'action' => 'edit', $id));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'title' => array(
		'label' => __('Título', true),
	),
	'description' => array(
		'label' => __('Descripción', true),
	),
	'video_id' => array(
		'label' => __('Vídeo', true),
		'options' => $videos,
		'empty' => __('No tiene vídeo asociado', true)
	),
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

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'photos', 'action' => 'index'));
