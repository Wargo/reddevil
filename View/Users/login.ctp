<?php
/**
 * If your login and password fields are not called username and password remember to change the field
 * names here AND change the auth component config (see the book) so that it correctly hashes the password
 */
?>
		<?php
		echo '<div class="logo">';
		echo $this->Html->image('logo_backoffice_login.png', array('class' => 'logo'));
		echo '</div>';
		echo $this->Form->create('User', array('class' => 'my_account clearfix formulario_login'));
		?>
		<fieldset class="login_grande">
		<legend><?php echo __('Datos de identificaci&oacute;n');?></legend>
		<div id="grafico">
		<?php echo $this->Html->image('llave.png',array('alt'=>'','width'=>128,'height'=>128,'class'=>'fixPNG'));?>
		</div>
		<?php
		echo $this->Form->input('username',array('label'=>__('Nombre de Usuario')));
		echo $this->Form->input('password',array('label'=>__('Contrase&ntilde;a')));
/*
		echo $this->Form->input('email', array(
			'fieldset' => false,
			'div' => 'clearfix clear', //username_input
			'after' => '<small>' . __('Lo usarás para entrar en la Web', true) .'</small>'
		));

		echo $this->Form->input('password', array(
			'fieldset' => false,
			'div' => 'clearfix',
			'error' => false,
			'label' => __('Contraseña', true),
			'after' => '<small>' . __('Sin espacios', true) .'</small>'
		));

		<div class="account_savechanges">
		<?php
		echo $this->Form->submit(__('Entrar', true), array('class' => 'big_button'));
		echo $this->Form->end(); ?>
		</div>
*/
?>
		<div class="contenedor_botones">
<div class="decoracion"></div>
<div class="botones">

<?php
echo $this->Form->button(__('Enviar'), array('type'=>'submit'));
?>
</div>
<div class="recordatorio">
<?php echo $this->Html->link(__('¿Has olvidado tu contraseña?'), array('controller' => 'users', 'action' => 'forgotten_password'));?>
</div>
<div class="registro">
<?php echo $this->Html->link(__('Registro'), array('controller' => 'users', 'action' => 'register'));?>
</div>

</fieldset>
<?php echo $this->Form->end();?>
