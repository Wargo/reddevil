<?php

	echo $this->element('Users/edit_' . $user['User']['group'] . '_menu', array('user_id' =>  $id));

?>


<div class="formulario_entrada">
<?php echo $this->Form->create('User', array('class' => 'autocomplete'));?>
	<fieldset>
 		<legend><?php echo __('Cambiar contraseña'); ?></legend>
<?php
		
			echo $this->Form->input('id');
			echo $this->Form->input('password', array('label' => __('Contraseña', true)));
			echo $this->Form->input('confirm', array('label' => __('Repetir contraseña', true), 'type' => 'password'));

	?>
	</fieldset>
<div class="botones">
<?php echo $this->Form->button(__('Cancelar',true), array('type'=>'button','onclick'=>'history.go(-1);return false;')); ?>
<?php echo $this->Form->button(__('Guardar',true), array('type'=>'submit')); ?>
</div>
<?php echo $this->Form->end();?>
</div>

