<div class="player">
<?php 
echo $this->Html->link(
		$this->Html->image('screenshots/6,fitCrop,964,542.jpg', array('alt' => 'Vídeo', 'class' => 'preview')),
		'/flash/trailers/video.flv',
		array('id' => 'player', 'class' => 'preview', 'escape' => false)
		);
?>
</div>
<script>
flowplayer("player", "/flash/flowplayer/flowplayer.swf", {
clip: {
autoPlay: true,
}
});
</script>
