<?php
$size = $mobileDevice?'m':'m';
$folder = explode('-', $main['Photo']['id']);
$folder = substr($folder[1], 0, 3);
$image = $this->Html->url('/img/Photo/' . $folder . '/' . $main['Photo']['id'] . ',fitCrop,964,542.jpg', array('class' => 'image', 'alt' => ''));

$this->Asset->js(array('detect_flash'));
echo $this->Asset->out('js');
?>
<script>
$(document).ready(function() {
	if (FlashDetect.installed) {
		//$('#html5').remove();
	} else {
		//$('#flash_player').html('<div class="no_flash_detected"><?php echo __('Parece que no dispones del flash player, puedes descargártelo %s', $this->Html->link(__('aquí'), 'http://www.adobe.com/go/getflashplayer', array('target' => '_blank'))); ?></div>');
	}
});
</script>
<div class="player">
	<?php if (
	true || // force html5 for all platforms
	strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'android') !== false || 
	strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipod') || 
	strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipad') || 
	strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone')) 
	{ ?>
		<div class="player_video" id="html5">
			<video controls="controls" width="964" height="542" poster="<?php echo $image; ?>">
				<source type="video/mp4" src="<?php echo $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']); ?>.mp4">
			</video>
		</div>
	<?php } else { ?>
		<div id="flash_player">
			<script type="text/javascript" src="http://toomuchmedia.reddevilx.com/jscript/flowplayer.js"></script>
			<div class="player_video"></div>
			<script>
			load_video();
			setTimeout(function() {
				load_video();
			}, 500);
			function load_video() {
				flowplayer(".player_video", {
					wmode:'transparent',
					src:'http://toomuchmedia.reddevilx.com/flash/flowplayer.swf',
					width: 964,
					height: 542
				}, {
					key: "$397432013148639",
					playlist: ['http://www.reddevilx.com<?php echo $image; ?>', {
						autoPlay: false,
						autoBuffering: true,
						loop: false,
						scaling:'fit',
						<?php if(USE_STREAMING):?>
						provider: 'hddn',
						//url: 'http://www.reddevilx.com/video/Trailer/mp4/<?php echo $size; ?>/<?php echo $Video['id']; ?>.mp4'
						url: 'Trailer/flv/<?php echo $size; ?>/<?php echo $Video['id']; ?>.flv'
						<?php else:?>
						url: 'http://www.reddevilx.com/video/Trailer/flv/<?php echo $size; ?>/<?php echo $Video['id']; ?>.flv'
						<?php endif;?>
						//url: 'http://www.reddevilx.com/video/Trailer/flv/<?php echo $size; ?>/<?php echo $Video['id']; ?>.flv'
						//linkUrl: "http://tour.reddevilx.com/track/NC4xLjMuNS4wLjMxLjAuMC4w"
					}],
					plugins: {
						controls: {
							all: false,
							opacity: 0.8,
							play: true,
							scrubber: true,
							mute: true,
							fullscreen: true
						},
						<?php if(USE_STREAMING):?>
        					// here is our rtmp plugin configuration
					        hddn: {
					            url: "http://toomuchmedia.reddevilx.com/flash/flowplayer.rtmp.swf",
					            // netConnectionUrl defines where the streams are found
					            netConnectionUrl: 'rtmp://reddevilx.com/reddevilx'
        					}
						<?php endif;?>
					}
				});
			}
			</script>
		</div>
	<?php } ?>
</div>

