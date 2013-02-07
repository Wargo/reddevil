<?php
echo $this->Form->create(null, array('class' => 'my_account clearfix formulario_login'));
?>
<fieldset class="login_grande">
<legend><?php echo __('Generar nueva contraseña');?></legend>

<p><small>
<?php echo __('Escribe tu email y el c&oacute;digo de verificaci&oacute;n que te hemos enviado a tu direcci&oacute;n email, as&iacute; podr&aacute;s acceder plenamente a CAIBV', true); ?>
</small></p>

<?php
$inputs = array(
	'fieldset' => false, 
	'legend' => __('Por favor, escribe tu email y el ci&oacute;digo para verificarlo', true), 
	$fields['email']
);
$inputs['token'] = array('label' => __('Código de verificación', true), 'size' => 40, 'default' => $token);
echo $this->Form->inputs($inputs);
?>
<div class="contenedor_botones">
<div class="decoracion"></div>
<div class="botones">
<?php
echo $this->Form->button(__('Enviar'), array('type'=>'submit'));
echo $this->Form->end();
?>
<div>

</div>
</fieldset>
