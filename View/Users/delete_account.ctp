<?php
$this->layout = 'home';
$this->Asset->js('clone');
echo $this->Form->create(null, array('class' => 'create_form'));
?>
<div id="account_personal_data" class="register_box clearfix">
	<div class="account_title">
			<h3><?php echo __('Configuración de mi cuenta', true); ?></h3>
			<p><?php echo __('Cambio de contraseña', true); ?></p>
	</div><!-- account_title -->
	<div class="register_icon"></div>

	<?php echo $this->element('account_menu', array('section' => 'password')); ?>

	<div class="personal_data user_name clearfix clear">
<?php
echo $this->Form->inputs(array(
	'legend' => false,
	'email' => array('type' => 'hidden'),
	'password' => array(
		'type' => 'password',
		'label' => __('Contraseña actual', true),
	),
));

echo $this->Form->inputs(array(
				'fieldset' => false,
				'legend' => false,
				'confirm_delete' => array(
					'label' => __('Confirmo que deseo desactivar mi cuenta en Interconnecting Sports', true),
					'div' => 'left input checkbox no_label',
					'class' => 'select_types',
					'type' => 'checkbox'
				),
			));
?>
</div>
</div>
<div class="account_savechanges">
	<?php echo $this->Form->submit(__('Desactivar mi cuenta', true), array('class' => 'big_button')); ?>
</div><!-- savechanges -->
<?php echo $this->Form->end(); ?>
