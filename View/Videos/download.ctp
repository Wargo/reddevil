<div class="title"><?php echo sprintf(__('Descargando %s'), $Video['title']); ?></div>
<div class="text">
	<?php
	echo '<p>' . __('¿Qué formato de descarga quieres?') . '</p>';
	$types = array('mp4', 'wmv', '3gp', 'flv');
	
	$i = 0;

	echo '<div class="clearfix">';
	foreach ($types as $type) {

		$i ++;

		if ($i %2) {
			$row = 'row_odd';
		} else {
			$row = 'row_even';
		}

		echo $this->Html->link($this->Html->image($type . '.png', array('align' => 'left')) . sprintf(__('Descargar en %s'), $type), array('controller' => 'videos', 'action' => 'formats', $Video['id'], $type), array('class' => '_select_size button ' . $row, 'escape' => false));

	}
	echo '</div>';
	?>
	<div class="_download_text"></div>
</div>
