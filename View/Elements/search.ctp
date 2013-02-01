<?php
echo $this->Form->create(null, array('class' => 'search', 'url' => array('controller' => 'videos', 'action' => 'search')));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'search' => array(
		'label' => false,
		'div' => false,
		'placeholder' => __('Buscar'),
	),
));

echo $this->Form->submit(__('Buscar'), array('div' => false, 'class' => 'search_button'));
echo $this->Form->end();
