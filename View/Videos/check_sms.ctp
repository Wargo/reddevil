<?php
if ($access) {
	echo $this->Html->url(array('controller' => 'videos', 'action' => 'view_video', $this->Session->read('current_video_id')));
}
