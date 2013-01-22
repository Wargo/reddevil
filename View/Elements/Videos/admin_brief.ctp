<?php
$title = ($mode=='trailer')?__('Trailer'):__('Video');
$duration = ($mode=='trailer')?$data['Video']['trailer_duration']:$data['Video']['duration'];
$_duration = (floor($duration/60)) . ':' . ($duration%60);
$formats = unserialize($this->request->data['Video']['formats']);
$id = $data['Video']['id'];
?>
<div class="input">
<label><?php echo $title ?></label>
<label><?php echo __('Duración: %s', $_duration); ?></label>
<?php if (!empty($formats['Trailer'])): ?>
<label><?php echo __('Formatos disponibles: %s', explode(', ', $formats['Trailer'])); ?></label>
<?php endif; ?>
<br/>
<?php
/* Screenshots desactivados
for ($i = 1; $i<=6; $i++) {
	echo $this->Html->image('Trailer/' . $id . '-' . $i . ',fitCrop,300,200.jpg');
} 
echo '<br/>';
*/

$conversion = ClassRegistry::init('Conversion')->find('first', array('conditions' => array('model' => 'Trailer', 'foreign_id' => $id)));
if ($conversion) {
	echo 'Conversión del video en curso';
} else {
	echo $this->Html->link(
		__('Programar conversión del trailer'), 
		array('controller' => 'conversions', 'action' => 'add', 'Trailer', $id)
	);
}
?>
</div>
