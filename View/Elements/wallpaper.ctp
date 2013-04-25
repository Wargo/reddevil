<?php
$conditions = array('active' => 1);
$order = array('created' => 'desc');
$Wallpaper = ClassRegistry::init('Wallpaper');
$wallpaper = $Wallpaper->find('first', compact('order', 'conditions'));

if ($wallpaper) {
	$avatar = $wallpaper['Wallpaper']['avatar'];
	$aux = '';
	if ($avatar != 'placeholder') {
		$aux = explode('-', $avatar);
		$aux = substr($aux[1], 0, 3);
	}
	$Video = ClassRegistry::init('Video');
	$url = $Video->field('slug', array('id' => $wallpaper['Wallpaper']['video_id']));

	echo $this->Html->link(
		$this->Html->image('Wallpaper/' . $aux . '/' . $avatar . '.jpg',	 array()),
		array('controller' => 'videos', 'action' => 'view', $url),
		array('class' => 'bg_promo_right', 'escape' => false));
	echo $this->Html->link(
		$this->Html->image('Wallpaper2/' . $aux . '/' . $avatar . '.jpg',	 array()),
		array('controller' => 'videos', 'action' => 'view', $url),
		array('class' => 'bg_promo_left', 'escape' => false));
}
