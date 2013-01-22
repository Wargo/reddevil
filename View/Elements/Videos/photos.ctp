<div class="player" id="gallery">
	<?php
	for ($i = 1; $i <= 7; $i ++) {
		echo $this->Html->link($this->Html->image('screenshots/' . $i . ',fitCrop,324,250.jpg', array('alt' => '')),
			'/img/screenshots/' . $i . ',fitInside,1024,768.jpg',
			array('escape' => false));
	}
	?>
</div>
<script type="text/javascript">
$(function() {
	$('#gallery a').lightBox();
});
</script>

