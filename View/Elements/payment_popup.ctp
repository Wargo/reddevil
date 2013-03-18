<?php 
echo '<span class="close_popup" style="cursor:pointer; color:#FFF; float:right; display:block; padding:2px 5px;">X</span>';
if (!$this->Session->read('Auth.User.id')) {
	echo $this->element('Users/register', array('video_id' => $id)); 
} else {
	echo $this->element('Users/payment', array('video_id' => $id)); 
}
?>
