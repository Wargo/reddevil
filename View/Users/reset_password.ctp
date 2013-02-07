<?php
/**
 * If your login and password fields are not called username and password remember to change the field
 * names here AND change the auth component config (see the book) so that it correctly hashes the password
 */

echo $this->Form->create(null, array('class' => 'my_account clearfix formulario_login'));
?>
<fieldset class="login_grande">
<legend><?php echo __('Por favor, introduce tu nueva contraseña');?></legend>
<?php
$inputs = array(
	'fieldset' => false,
	'token' => array('type' => 'hidden'),
	'email' => array('type' => 'hidden'),
);

// Uncomment if Auth uses the username field
if ($fields['confirmation']) {
	$inputs[] = $fields['confirmation'];
}
$inputs = am($inputs, array(
	'password',
	'confirm' => array('type' => 'password'),
	/*
	'generate' => array(
		'type' => 'checkbox',
		'label' => __('Generar una contraseña aleatoria (se mostrará en la siguiente pantalla)', true)
	),
	*/
));
echo $this->Form->inputs($inputs);
?>
<div class="contenedor_botones">
<div class="decoracion"></div>
<div class="botones">

<?php
echo $this->Form->button(__('Enviar'), array('type'=>'submit'));
?>
</div>

</div>

</fieldset>
<?php echo $this->Form->end(); ?></div>
