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

<?php
echo $this->Form->create('User', array('class' => 'register clearfix', 'url' => array('controller' => 'users', 'action' => 'register')));

echo '<span class="text_big small" style="display:block; margin-left:10px; margin-top:40px;">' . __('Registro') . '</span>';

echo $this->Form->input('username', array(
	'fieldset' => false, 
	'label' => false,
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

echo $this->Form->button(__('Hacerme socio'), array('type'=>'submit'));

echo $this->Form->end();
