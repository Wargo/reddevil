<div class="title"><?php echo sprintf(__('Compartir el vídeo "%s"'), $Video['title']); ?></div>
<div class="text">
	<?php
	echo '<p>' . __('¿Dónde lo quieres compartir?') . '</p>';
	$types = array('facebook', 'twitter');
	
	$i = 0;

	echo '<div class="clearfix">';
	foreach ($types as $type) {

		$i ++;

		if ($i %2) {
			$row = 'row_odd';
		} else {
			$row = 'row_even';
		}

		echo $this->Html->link($this->Html->image($type . '.png', array('align' => 'absmiddle')) . sprintf(__('Compartir en %s'), ucfirst($type)), array(), array('class' => 'button ' . $row, 'escape' => false));

	}
	echo '</div>';
	?>
</div>
