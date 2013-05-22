<?php
echo '<div class="link_promo">';
	echo $this->Html->link($this->Html->image('bg/banner.jpg'), 'http://www.reddevilx.com/trailer/pablo-ferrari-carmen-y-aris-dark-en-las-corridas-de-san-isidro', array('escape' => false));
	//echo $this->Html->image('bg/banner.jpg');
	echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
echo '</div>';
