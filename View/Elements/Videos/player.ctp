<?php
$size = $mobileDevice?'s':'m';
$folder = explode('-', $main['Photo']['id']);
$folder = substr($folder[1], 0, 3);
$image = $this->Html->url('/img/Photo/' . $folder . '/' . $main['Photo']['id'] . ',fitCrop,964,542.jpg', array('class' => 'image', 'alt' => ''));
?>
<div class="player">
	<?php
	//if (!Configure::read('debug')) {
	if (true || stristr($_SERVER['HTTP_USER_AGENT'], 'ipad') || stristr($_SERVER['HTTP_USER_AGENT'], 'iphone')) {
		?>
		<div class="player_video">
			<div class="flowplayer is-splash play-button" 
				<?php echo 'style="background-image:url('.$image.')"'; ?>
				data-swf="<?php echo $this->Html->url('/html5/flowplayer/flowplayer.swf'); ?>">
				<video>
					<source type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"' src="<?php echo $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']); ?>.mp4"/>
					<source type='video/ogg; codecs="theora, vorbis"' src="<?php echo $this->Html->url('/video/Trailer/ogg/'.$size.'/' . $Video['id']); ?>.ogg"/>
					<source type="video/flash" src="<?php echo $this->Html->url('/video/Trailer/flv/'.$size.'/' . $Video['id']); ?>.flv"/>
				</video>
			</div>
		</div>
		<script>
			$(".flowplayer").flowplayer({
				tooltip: false,
				'key': '$397432013148639',
				'logo' : '<?php echo $this->Html->url('/img/logo.png', true); ?>'
			});
		</script>
		<?php
	} else {
		?>
		<div class="player_video"></div>
		<script type="text/javascript" src="http://toomuchmedia.reddevilx.com/jscript/flowplayer.js"></script>
		<script>
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
				url: 'http://www.reddevilx.com/video/Trailer/mp4/<?php echo $size; ?>/<?php echo $Video['id']; ?>.mp4'
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
		</script>
		<?php
	}
	?>
</div>

