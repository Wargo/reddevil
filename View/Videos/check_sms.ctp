<?php
if ($access) {
	$slug = ClassRegistry::init('Video')->field('slug', array('id' => $this->Session->read('current_video_id')));
	echo $this->Html->url(array('controller' => 'videos', 'action' => 'view_video', $slug));
}
