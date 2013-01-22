<div class="player" id="gallery">
	<?php
	$photos = classregistry::init('Photo')->getPhotos($Video['id']);

	foreach ($photos as $photo) {
		extract($photo);
		$aux = explode('-', $Photo['id']);
		$folder = substr($aux[1], 0, 3);
		$path = '/img/Photo/' . $folder . '/' . $Photo['id'] . ',fitInside,1024,768.jpg';
		echo $this->Html->link($this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,324,250.jpg', array('alt' => '')),
			$path,
			array('escape' => false));
	}
	?>
</div>
<script type="text/javascript">
$(function() {
	$('#gallery a').lightBox();
});
</script>

