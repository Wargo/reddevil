<div class="title"><?php echo __('Registrarse en Red Devil X'); ?></div>
<div class="register text">
<?php 
if (!$this->Session->read('Auth.User.id')) {
	echo $this->element('Users/register', array('video_id' => $Video['id'])); 
} elseif ((strtotime($this->Session->read('Auth.User.caducidad')) < time())) {
	echo $this->element('Users/payment', array('video_id' => $Video['id'])); 
}
?>
</div>

