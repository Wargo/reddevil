<?php
echo $this->Form->create('User', array('class' => 'clearfix', 'url' => array('controller' => 'users', 'action' => 'renew')));

echo '<div class="payment">';
	echo $this->Form->radio('payment', 
		array('day' => __('Diario 3€'), 'month' => __('Mensual 20€'), '3month' => __('Trimestral 50€'), 'year' => __('Anual 80€'), 'member' => __('Ya estoy suscrito a Red Devil x')),
		array('legend' => __('Tipo de suscripción'), 'separator' => '<br/>', 'value' => 'month')
	);

echo $this->Form->button(__('Renovar suscripción'), array('type'=>'submit'));

echo '</div>';

echo $this->Form->end();
