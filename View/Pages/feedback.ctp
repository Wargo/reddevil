<div class="title"><?php echo __('Sugerencias'); ?></div>
<div class="text">
	<?php
	echo $this->Form->create('Contact', array('class' => 'dialog_form wannabe_form', 'url' => array('controller' => 'contacts', 'action' => 'feedback')));

	echo $this->Form->inputs(array(
		'fieldset' => false,
		'comment' => array(
			'label' => __('¿Quieres dejarnos alguna sugerencia?'),
			'placeholder' => 'Si has encontrado algún tipo de error de funcionamiento o contenido...',
			'type' => 'textarea',
			'div' => 'input textarea big'
		)
	));

	echo $this->Form->submit(__('Enviar formulario'));
	echo $this->Form->end();
	?>
</div>
