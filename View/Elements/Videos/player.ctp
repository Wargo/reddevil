<?php
$size = $mobileDevice?'s':'m';
$folder = explode('-', $main['Photo']['id']);
$folder = substr($folder[1], 0, 3);
$image = $this->Html->url('/img/Photo/' . $folder . '/' . $main['Photo']['id'] . ',fitCrop,964,542.jpg', array('class' => 'image', 'alt' => ''));
?>
<div class="player">
	<div class="player_video">
		<div class="flowplayer is-splash" 
			<?php echo 'style="background-image:url('.$image.')"'; ?>
			data-swf="<?php echo $this->Html->url('/html5/flowplayer/flowplayer.swf'); ?>">
			<video>
				<source type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"' src="<?php echo $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']); ?>.mp4"/>
				<source type='video/ogg; codecs="theora, vorbis"' src="<?php echo $this->Html->url('/video/Trailer/ogg/'.$size.'/' . $Video['id']); ?>.ogg"/>
				<source type="video/flash" src="<?php echo $this->Html->url('/video/Trailer/flv/'.$size.'/' . $Video['id']); ?>.flv"/>
			</video>
		</div>
	</div>
</div>

<script>
	$(".flowplayer").flowplayer({
		'key': '$397432013148639',
		'logo' : '<?php echo $this->Html->url('/img/logo.png', true); ?>'
	});
</script>

