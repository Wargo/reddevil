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
	switch ($i) {
		case 1: $title = 'Vas a saber lo que es confundirme la noche...'; break;
		case 2: $title = 'Y si viene tu madre... me la follo también!'; break;
		case 3: $title = 'Me echó Marujita a la puta calle...'; break;
		case 4: $title = 'Es que estoy haciendo deporte en la playa...'; break;
		case 5: $title = 'Le quité un chalet y un piso...'; break;
		case 6: $title = 'Madre mía... pedazo culito que me voy a follar!'; break;
		case 7: $title = 'Voy a limpiarte la fresita que van a pensar que te rompí el culito'; break;
	}
	echo '
	<div class="block_mini_video">
		<div class="mini_video mini_video_' . $i . '"></div>
		<a title="Para descargar: Botón derecho -> guardar enlace" class="whatsapp" target="_blank" href="http://reddevilx.com/pills/' . $id . '/' . $video . '">Descargar</a>
		<span class="title">' . $title . '</span>
		<script>
		flowplayer(".mini_video_' . $i . '", {
			wmode:\'transparent\',
			src:\'http://toomuchmedia.reddevilx.com/flash/flowplayer.swf\',
			width: 300,
			height: 200
		}, {
			playlist: [\'http://reddevilx.com/img/Photo/e41/515eb7a0-e41c-4780-b624-1a3fbca5e1a6.jpg\', {
				autoPlay: false,
				autoBuffering: false,
				loop: false,
				url: \'http://reddevilx.com/pills/' . $id . '/' . $video . '\',
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
	</div>
	';
}
?>
</div>
