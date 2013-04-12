<?php
echo '<div class="link_promo">';
	echo $this->Html->image('bg/banner.jpg');
	echo $this->Html->link($this->Html->image('promo.png', array()), array(), array('escape' => false));
echo '</div>';
