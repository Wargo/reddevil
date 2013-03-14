<?php
if ($access) {
	if ($this->Session->read('current_video_id')) {
		$slug = ClassRegistry::init('Video')->field('slug', array('id' => $this->Session->read('current_video_id')));
		echo $this->Html->url(array('controller' => 'videos', 'action' => 'view_video', $slug));
	} else {
		echo $this->Html->url(array('controller' => 'videos', 'action' => 'home'));
	}
}
