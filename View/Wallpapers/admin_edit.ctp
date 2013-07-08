<?php
$avatar = (!empty($this->request->data['Wallpaper']['avatar']))?$this->request->data['Wallpaper']['avatar']:'placeholder';
$aux = '';
if ($avatar != 'placeholder') {
	$aux = explode('-', $avatar);
	$aux = substr($aux[1], 0, 3);
}
echo $this->Form->create('Wallpaper', array('type' => 'file', 'url' => array('controller' => 'wallpapers', 'action' => 'edit', $id)));

echo $this->Form->inputs(array(
	'fieldset' => false,
	'name' => array(
		'label' => __('Nombre'),
	),
	'file' => array(
		'label' => __('Foto izquierda'),
		'type' => 'file',
		'after' => $this->Html->image('Wallpaper/' . $aux .'/' . $avatar . '.jpg', array('width' => 300))
	),
	'file2' => array(
		'label' => __('Foto derecha'),
		'type' => 'file',
		'after' => $this->Html->image('Wallpaper2/' . $aux .'/' . $avatar . '.jpg', array('width' => 300))
	),
	'file3' => array(
		'label' => __('Banner central'),
		'type' => 'file',
		'after' => $this->Html->image('bg/' . $aux .'/' . $avatar . '.jpg', array('width' => 300))
	),
	'video_id' => array('label' => __('Video asociado')),
	'avatar' => array('type' => 'hidden', 'value' => $avatar)
));

echo $this->Form->end(__('Guardar', true));
echo $this->Html->link(__('Cancelar', true), array('controller' => 'wallpapers', 'action' => 'index'));
