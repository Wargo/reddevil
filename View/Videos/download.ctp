<div class="title"><?php echo sprintf(__('Descargando %s'), $Video['title']); ?></div>
<div class="text">
	<?php
	//echo '<p>' . __('¿Qué formato de descarga quieres?') . '</p>';
	$formats = Configure::read('formats');
	
	$i = 0;

	echo '<div class="clearfix">';
	foreach ($formats as $type) {

		$type = $type['folder'];

		$i ++;

		if ($i %2) {
			$row = 'row_odd';
		} else {
			$row = 'row_even';
		}

		echo $this->Html->link($this->Html->image($type . '.png', array('align' => 'left')) . sprintf(__('Descargar en %s'), $type),
			array('controller' => 'videos', 'action' => 'formats', $Video['id'], $type),
			array('class' => '_select_size button ' . $row, 'escape' => false));

	}
	echo '</div>';
	?>
	<!--<div class="_download_text"></div>-->
	<div style="display: block; margin: 20px auto; width: 220px; text-align: center;">Deshabilitado temporalmente</div>
</div>
