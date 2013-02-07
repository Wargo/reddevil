<div class="title"><?php echo sprintf(__('Compartir el vídeo "%s"'), $Video['title']); ?></div>
<div class="text">
	<?php
	echo '<p>' . __('¿Dónde lo quieres compartir?') . '</p>';
	$types = array(
		'facebook' => 'http://www.facebook.com/sharer.php?u=',
		'twitter' => 'http://twitter.com/home?status=',
		'google+' => 'https://plus.google.com/share?url=',
		'tuenti' => 'http://www.tuenti.com/share?url=',
	);
	
	$i = 0;

	echo '<div class="clearfix">';
	foreach ($types as $type => $url) {

		$i ++;

		if ($i %2) {
			$row = 'row_odd';
		} else {
			$row = 'row_even';
		}

		echo $this->Html->link($this->Html->image($type . '.png', array('align' => 'left')) . sprintf(__('Compartir en %s'), ucfirst($type)), $url . $this->Html->url(array('full_base' => true, 'controller' => 'videos', 'action' => 'view', $Video['slug'])), array('class' => '_popup button ' . $row, 'escape' => false));

	}
	echo '</div>';
	?>
</div>
