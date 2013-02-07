<?php
/**
 * If your login and password fields are not called username and password remember to change the field
 * names here AND change the auth component config (see the book) so that it correctly hashes the password
 */
echo $this->Form->create(null, array('class' => 'my_account clearfix formulario_login'));
?>
<fieldset class="login_grande">
<legend><?php echo __('Recuperar contraseña');?></legend>

<p><small>
	<?php echo __('Si has olvidado tu contraseña, puedes reiniciarla enviando este formulario.'); ?>
</small></p>
<p><small>
	<?php echo __('Te enviaremos un email que debes leer para continuar, esto confirma que realmente eres tú el que quieres cambiar la contraseña. Todo lo que necesitas es leer el email, seguir el enlace, rellenar algunos datos de verificación y escribir tu nueva contraseña.', true); ?>
</small></p>

	<?php
	
	if ($authFields['username'] == 'email') {
		echo $this->Form->input('email');
	} else {
		echo $this->Form->input('code', array('label' => __('C�digo')));
	}
?>
<div class="contenedor_botones">
<div class="decoracion"></div>
<div class="botones">

<?php echo $this->Form->button(__('Enviar'), array('type'=>'submit')); ?>
</div>

</div>

</fieldset>
<?php echo $this->Form->end();?>
