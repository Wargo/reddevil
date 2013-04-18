<?php
echo '<div class="link_promo">';
	//echo $this->Html->link($this->Html->image('bg/banner.jpg'), array('controller' => 'videos', 'action' => 'whatsapp', '515eb1f3-3314-4734-858d-1a3fbca5e1a6'), array('escape' => false));
	echo $this->Html->image('bg/banner.jpg');
	echo $this->Html->link($this->Html->image('promo.png', array()), array('controller' => 'users', 'action' => 'profile'), array('escape' => false, 'class' => 'go_my_profile'));
echo '</div>';
