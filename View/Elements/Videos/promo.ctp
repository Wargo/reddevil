<?php
echo '<div class="link_promo">';
	echo $this->Html->link($this->Html->image('bg/banner.jpg'), 'http://www.reddevilx.com/trailer/mademoiselle-justine-y-juan-lucho-en-la-trucha-de-juan-lucho-a-la-francesa', array('escape' => false));
	//echo $this->Html->image('bg/banner.jpg');
	echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
echo '</div>';
