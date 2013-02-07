<div class="formulario_entrada">
<h2><?php echo __('Mi cuenta') ?></h2>

<?php 
echo $this->Form->create('User', array(
	'url' => array($this->Session->read('Auth.User.group') => true, 'controller' => 'users', 'action' => 'modificar')
));
?>
<fieldset class="configuracion">
<legend><?php echo __('Datos de usuario') ?></legend>
	<?php
		echo $this->Form->input('email', array('label' => __('E-mail', true)));
		echo $this->Form->input('first_name', array('label' => __('Nombre', true)));
		echo $this->Form->input('last_name', array('label' => __('Apellidos', true)));
	?>

<div class="botones">
<?php echo $this->Form->button(__('Guardar',true), array('type'=>'submit')); ?>
</div>
</fieldset>
<?php echo $this->Form->end();?>
</fieldset>
</div>

<?php echo $this->element('Users/mi_cuenta_' . $this->Session->read('Auth.User.group')); ?>


<div class="formulario_entrada">
<?php echo $this->Form->create('User', array(
	'url' => array(
		$this->Session->read('Auth.User.group') => true, 
		'controller' => 'users', 
		'action' => 'cambiar_contrasena', 
		$this->Session->read('Auth.User.id'))
));
?>
	<fieldset>
 		<legend><?php echo __('Cambiar contraseña'); ?></legend>
<?php
		
			echo $this->Form->input('id');
			echo $this->Form->input('password', array('label' => __('Contraseña', true)));
			echo $this->Form->input('confirm', array('label' => __('Repetir contraseña', true), 'type' => 'password'));

	?>

<div class="botones">

<?php echo $this->Form->button(__('Guardar',true), array('type'=>'submit')); ?>

</div>
<?php echo $this->Form->end();?>
</fieldset>
</div>
