<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700' rel='stylesheet' type='text/css'>
<div class="left_part">
	<p class="text_big">
		<span class="blue">
		<?php echo __('Hazte socio de RedDevilX'); ?>
		</span>
		<?php echo __('Y accede a todos nuestros vídeos y a los extras de los rodajes'); ?>
	</p>
	<p class="text_big small">
		<?php echo __('Menos de 1 € al día'); ?>
	</p>
</div>

<style>

.register_button {
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1E8ABF', endColorstr='#66AAD2');
	background-image: -webkit-gradient(linear, left top, left bottom, from(#1E8ABF), to(#66AAD2));
	background-image: -webkit-linear-gradient(top, #1E8ABF, #66AAD2);
	background-image: -moz-linear-gradient(top, #1E8ABF, #66AAD2);
	border-color: #2D6324;
	border-radius: 4px 4px 4px 4px;
	border-width: 1px;
	color: #FFFFFF;
	cursor: pointer;
	font-size: 18px;
	margin: 15px 10px;
	padding: 8px 15px;
	text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.5);
	float:left;
}
</style>

<?php

echo $this->Form->create('User', array('class' => 'register clearfix', 'url' => array('controller' => 'users', 'action' => 'login')));

echo '<span class="text_big small" style="display:block; margin-left:10px; margin-top:10px;">' . __('Accede') . ':</span>';

echo $this->Form->input('username', array(
	'fieldset' => false, 
	'label' => false,
	'id' => 'username',
	'placeholder' => __('Nombre de usuario', true),
));

echo $this->Form->input('password', array(
	'fieldset' => false, 
	'error' => false,
	'label' => false,
	'placeholder' => __('Contraseña', true),
));

if (!empty($slug)) {
	echo $this->Form->hidden('slug', array('value' => $slug));
}

echo $this->Form->button(__('Acceder'), array('type'=>'submit', 'id' => 'submit_register'));
echo $this->Html->image('preload.gif', array('class' => 'hidden preload'));

echo '<span class="text_big small" style="display:block; margin-left:10px; margin-top:20px;">' . __('Regístrate') . ':</span>';
echo $this->Html->link('SMS', array('controller' => 'users', 'action' => 'register'), array('class' => 'register_button'));
echo $this->Html->link('Tarjeta', 'http://tour.reddevilx.com/signup/signup.php?nats=MC4wLjMuNS4wLjAuMC4wLjA&step=2', array('class' => 'register_button'));

echo $this->Form->end();
