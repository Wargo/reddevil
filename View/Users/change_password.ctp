<?php
$this->layout = 'admin_login';
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
	'current_password' => array(
		'type' => 'password',
		'label' => __('Contraseña actual', true),
	),
));
?>
</div>
<div class="personal_data user_name clearfix clear">
<?php
echo $this->Form->inputs(array(
	'legend' => false,
	'password' => array(
		'type' => 'password',
		'label' => __('Nueva contraseña', true),
		'class' => 'change_password',
	),
	'confirm' => array(
		'type' => 'password',
		'label' => __('Repetir contraseña', true),
		'class' => 'change_password',
	),
));
?>

</div>
</div>
<div class="account_savechanges">
	<?php echo $this->Form->submit(__('Cambiar contraseña', true), array('class' => 'big_button')); ?>
</div><!-- savechanges -->
<?php echo $this->Form->end(); ?>
