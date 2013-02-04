<?php
$main = ClassRegistry::init('Photo')->find('first', array(
	'conditions' => array(
		'video_id' => $Video['id'],
		'main' => 1
	),
));
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
				<source type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"' src="<?php echo $this->Html->url('/video/Trailer/' . $Video['id']); ?>"/>
			</video>
		</div>
	</div>
</div>
<?php if ($this->request->is('ajax')): ?>
<script>
	$(".flowplayer").flowplayer({});
</script>
<?php endif; ?>
