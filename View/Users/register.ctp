<?php
		echo '<div class="logo">';
		echo $this->Html->image('logo_backoffice_login.png', array('class' => 'logo'));
		echo '</div>';
echo $this->Form->create('User', array('class' => 'my_account clearfix formulario_login'));

?>
	<fieldset class="login_grande">
		<legend><?php echo __('Registro de comercializador');?></legend>

<?php
echo $this->Form->input('first_name', array(
	'fieldset' => false, 

	'label' => __('Nombre', true) . ' *',
));
echo $this->Form->input('last_name', array(
	'fieldset' => false, 

	'label' => __('Apellidos', true),
));
?>




<?php
echo $this->Form->input('email', array(
	'fieldset' => false, 

	'label' => __('Email', true) . ' *',
));
?>


<?php
echo $this->Form->input('password', array(
	'fieldset' => false, 

	'error' => false,
	'label' => __('Contraseña', true) . ' *',
));
echo $this->Form->input('confirm', array(
	'fieldset' => false, 

	'type' => 'password',
	'label' => __('Repetir contraseña', true) . ' *',
));
echo $this->Form->error('password');
?>




<?php
/*
echo $this->Form->input('tos', array('div' => 'clearfix username_checkbox clear', 'fieldset' => false, 'type' => 'checkbox',
	'label' => sprintf(__('Estoy de acuerdo con los %1$s'), 
							$this->Html->link(__('términos de uso', true), array('controller' => 'pages', 'action' => 'display', 'tos'), array('class' => 'popup modal noResize noDrag dialog_link', 'var' => __('Términos del servicio', true))))));
*/
?>

		<div class="contenedor_botones">
<div class="decoracion"></div>
<div class="botones">
<?php
echo $this->Form->button(__('Registrarse'), array('type'=>'submit'));
?>

</div>
</fieldset>
<?php echo $this->Form->end();?>
