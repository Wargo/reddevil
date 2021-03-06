<?php $registered = ($this->Session->read('Auth.User.id') && strtotime($this->Session->read('Auth.User.caducidad'))>time()); ?>
<div class="player" id="gallery">
	<?php
	$photos = classregistry::init('Photo')->getPhotos($Video['id']);

	$id = '';
	foreach ($photos as $photo) {
		extract($photo);
		if ($photo_id == $Photo['id']) {
			$id = '_openMe';
		}
		$aux = explode('-', $Photo['id']);
		$folder = substr($aux[1], 0, 3);
		if ($registered) {		
			$path = '/img/Photo/' . $folder . '/' . $Photo['id'] . ',fitInside,1024,768.jpg';
		} else {
			$path = '/';
		}

		$alt = ClassRegistry::init('Photo')->getTitle($Photo);

		echo $this->Html->link($this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,324,250.jpg', array('alt' => $alt, 'title' => $alt)),
			$path,
			array('escape' => false, 'id' => $id, 'title' => $alt));
		$id = '';
	}
	?>
</div>
<script type="text/javascript">
<?php if ($registered): ?>
$(function() {
	$('#gallery a').lightBox();
	$.scrollTo('#buttons', 200, {offset:{top:-100}});
	setTimeout(function() {
		$('#_openMe').click();
	}, 500);
});
<?php else: ?>
	$('#gallery a').bind('click', function() { 
		load_popup();
		return false;
	});
	<?php if (!empty($photo_id)) {
		echo 'load_popup();';
	} ?>
<?php endif; ?>
</script>

