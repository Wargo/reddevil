<script type="text/javascript" src="http://toomuchmedia.reddevilx.com/jscript/flowplayer.js"></script>
<?php
echo $this->Html->image('baner_wsap.png');
?>
<div class="clearfix">
<?php
$i = 0;
foreach ($videos as $video) {
	$exclude = array('.', '..', 'empty');
	if (in_array($video, $exclude)) {
		continue;
	}
	$i ++;
	echo '
	<div class="block_mini_video">
		<div class="mini_video mini_video_' . $i . '"></div>
		<a class="whatsapp" href="http://reddevilx.com/pills/' . $video . '">Descargar</a>
		<script>
		flowplayer(".mini_video_' . $i . '", {
			src:\'http://toomuchmedia.reddevilx.com/flash/flowplayer.swf\',
			width: 300,
			height: 200}, {
				playlist: [\'http://reddevilx.com/img/Photo/e41/515eb7a0-e41c-4780-b624-1a3fbca5e1a6.jpg\', {
					autoPlay: false,
					autoBuffering: false,
					loop: false,
					url: \'http://reddevilx.com/pills/' . $video . '\',
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
			}
		);
		</script>
	</div>
	';
}
?>
</div>
