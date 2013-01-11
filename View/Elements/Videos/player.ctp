<div class="player">
	<div class="player_video">

<div class="flowplayer is-splash" 
	<?php echo 'style="background-image:url('.$this->Html->url('/img/screenshots/6,fitCrop,964,542.jpg').')"'; ?>
	data-swf="<?php echo $this->Html->url('/html5/flowplayer/flowplayer.swf'); ?>">
<video>
	<source type="video/mp4" src="<?php echo $this->Html->url('/flash/trailers/video.mp4'); ?>"/>
</video>
</div>
<?php
/*
echo $this->Html->link(
		$this->Html->image('screenshots/6,fitCrop,964,542.jpg', array('alt' => 'Vídeo', 'class' => 'preview')),
		'/flash/trailers/video.flv',
		array('id' => 'player', 'class' => 'preview', 'escape' => false)
		);
*/
?>
	</div>
</div>
<?php /*
<script>
flowplayer("player", "<?php echo $this->Html->url('/flash/flowplayer/flowplayer.swf'); ?>", {
	clip: {
		autoPlay: true,
		scaling: 'orig'
	}
});
</script>
*/
