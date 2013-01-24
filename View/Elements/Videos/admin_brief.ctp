<?php
$title = ($mode=='Trailer')?__('Trailer'):__('Video');
$duration = ($mode=='Trailer')?$data['Video']['trailer_duration']:$data['Video']['duration'];
$_duration = (floor($duration/60)) . ':' . ($duration%60);
$formats = unserialize($this->request->data['Video']['formats']);
$id = $data['Video']['id'];
?>
<div class="input">
<label><?php echo $title ?></label>
<label><?php echo __('Duración: %s', $_duration); ?></label>
<?php if (!empty($formats[$mode])): 
	$_formats = array();
	foreach ($formats[$mode] as $format => $active) {
		if ($active) {
			$_formats[] = $format;
		}
	}
?>
<label><?php echo __('Formatos disponibles: %s', implode(', ', $_formats)); ?></label>
<?php endif; ?>
<br/>
<?php
if (Configure::read('GenerateScreenshots')) {
	for ($i = 1; $i<=6; $i++) {
		echo $this->Html->image($mode . '/' . $id . '-' . $i . ',fitCrop,300,200.jpg');
	} 
	echo '<br/>';
}

$conversion = ClassRegistry::init('Conversion')->find('first', array('conditions' => array('model' => $mode, 'foreign_id' => $id)));
if ($conversion) {
	switch ($conversion['Conversion']['state']) {
		case 0: 
			echo __('Conversión del video en programada');
		break;
		case 1:
			echo __('Conversión del video en curso');
		break;
		case 2:
			echo __('Conversión del video finalizada');
		break;
	}
} else {
	echo $this->Html->link(
		__('Programar conversión del %s', $title), 
		array('controller' => 'conversions', 'action' => 'add', $mode, $id)
	);
}
?>
</div>
