<?php
$size = $mobileDevice?'s':'m';
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
		$('#flash_player').html('<div class="no_flash_detected"><?php echo __('Parece que no dispones del flash player, puedes descargártelo %s', $this->Html->link(__('aquí'), 'http://www.adobe.com/go/getflashplayer', array('target' => '_blank'))); ?></div>');
	}
});
</script>
<div class="player">
	<?php if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipod') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipad') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone')) { ?>
	<div class="player_video" id="html5">
		<div class="flowplayer is-splash play-button" 
			<?php echo 'style="background-image:url('.$image.')"'; ?>
			data-swf="<?php echo $this->Html->url('/html5/flowplayer/flowplayer.swf'); ?>">
			<video>
				<source type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"' src="<?php echo $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']); ?>.mp4"/>
				<source type='video/ogg; codecs="theora, vorbis"' src="<?php echo $this->Html->url('/video/Trailer/ogg/'.$size.'/' . $Video['id']); ?>.ogg"/>
				<source type="video/flash" src="<?php echo $this->Html->url('/video/Trailer/flv/'.$size.'/' . $Video['id']); ?>.flv"/>
			</video>
		</div>
		<script>
			$(".flowplayer").flowplayer({
				tooltip: false,
				'key': '$397432013148639',
				'logo' : '<?php echo $this->Html->url('/img/logo.png', true); ?>'
			});
		</script>
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
				key: '$397432013148639',
				playlist: ['http://www.reddevilx.com<?php echo $image; ?>', {
					autoPlay: false,
					autoBuffering: true,
					loop: false,
					//url: 'http://www.reddevilx.com/video/Trailer/mp4/<?php echo $size; ?>/<?php echo $Video['id']; ?>.mp4'
					url: 'http://www.reddevilx.com/video/Trailer/flv/<?php echo $size; ?>/<?php echo $Video['id']; ?>.flv'
					//linkUrl: "http://tour.reddevilx.com/track/NC4xLjMuNS4wLjMxLjAuMC4w"
				}],
				plugins: {
					controls: {
						all: false,
						play: true,
						scrubber: true,
						mute: true,
						fullscreen: true
					}
				}
			});
		}
		</script>
	</div>
	<?php } ?>
</div>

