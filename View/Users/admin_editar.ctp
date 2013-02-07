<?php
if (!empty($this->data['User']['id'])) {
	$group = $this->data['User']['group']; 
	echo $this->element('Users/edit_' . $group . '_menu', array('user_id' =>  $this->data['User']['id']));
}
?>
<div class="formulario_entrada">
<h2><?php echo empty($id)?__('Nuevo usuario', true):__('Editar usuario', true); ?></h2>
<?php echo $this->Form->create('User', array('class' => 'autocomplete'));?>
	<fieldset>
 		<legend><?php echo __('Datos del usuario');?></legend>
<?php
		if (!empty($id)) {
			echo $this->Form->input('id');
		}
		echo $this->Form->input('email', array('label' => __('E-mail', true)));
		if (empty($id)) {
			echo $this->Form->input('password', array('label' => __('Contraseña', true)));
			echo $this->Form->input('confirm', array('label' => __('Repetir contraseña', true), 'type' => 'password'));
		}
		echo $this->Form->input('first_name', array('label' => __('Nombre', true)));
		echo $this->Form->input('last_name', array('label' => __('Apellidos', true)));
		echo $this->Form->input('group', array('type' => 'select', 'label' => __('Tipo de usuario', true)));
		echo $this->Form->input('active', array('label' => __('Cuenta activa', true)));


	?>
	</fieldset>
<div class="botones">
<?php echo $this->Form->button(__('Cancelar',true), array('type'=>'button','onclick'=>'history.go(-1);return false;')); ?>
<?php echo $this->Form->button(__('Guardar',true), array('type'=>'submit')); ?>
</div>
<?php echo $this->Form->end();?>
</div>
