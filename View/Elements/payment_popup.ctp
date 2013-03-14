<?php 
if (!$this->Session->read('Auth.User.id')) {
	echo $this->element('Users/register', array('video_id' => $id)); 
//} elseif ((strtotime($this->Session->read('Auth.User.caducidad')) < time())) {
} else {
	echo $this->element('Users/payment', array('video_id' => $id)); 
}
?>
