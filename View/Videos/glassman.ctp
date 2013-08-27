<?php
$size = $mobileDevice?'m':'m';
$folder = explode('-', $main['Photo']['id']);
if (!empty($folder[1])) {
	$folder = substr($folder[1], 0, 3);
	$image = $this->Html->url('/img/Photo/' . $folder . '/' . $main['Photo']['id'] . ',fitCrop,964,542.jpg', array('class' => 'image', 'alt' => ''));
} else {
	$image = '';
}

$this->Asset->js(array('detect_flash'));
echo $this->Asset->out('js');
?>
<script>
$(document).ready(function() {
	if (!FlashDetect.installed) {
		$('#flash_player').html('<div class="no_flash_detected"><?php echo __('Parece que no dispones del flash player, puedes descargártelo %s', $this->Html->link(__('aquí'), 'http://www.adobe.com/go/getflashplayer', array('target' => '_blank'))); ?></div>');
	}
});
</script>
<div class="player">
	<?php if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipod') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'ipad') || strpos(strtolower($_SERVER['HTTP_USER_AGENT']), 'iphone')) { ?>
		<?php
		if ($this->Session->read('Auth.User.caducidad') > date('Y-m-d H:i:s')) {
			$link = Security::hash($this->Session->read('Auth.User.id') . '_' . $Video['id'], null, true);
			?>
			<video src="<?php echo $this->Html->url('/links/' . $this->Session->read('Auth.User.id') . '/' . $link . '_mp4_m.mp4'); ?>" controls="controls" width="964" height="542" poster="<?php echo $image; ?>"></video>
			<?php
		} else {
			?>
			<video src="<?php echo $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']); ?>.mp4" controls="controls" width="964" height="542" poster="<?php echo $image; ?>"></video>
			<?php
		}
	} else {
		if ($this->Session->read('Auth.User.caducidad') > date('Y-m-d H:i:s')) {

			$link = Security::hash($this->Session->read('Auth.User.id') . '_' . $Video['id'], null, true);
			$url = 'http://www.reddevilx.com' . $this->Html->url('/links/' . $this->Session->read('Auth.User.id') . '/' . $link . '_flv_m.flv');

		} else {

			$url = 'http://www.reddevilx.com' . $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']) . '.mp4';

		}
		?>
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
						//url: 'http://www.reddevilx.com/video/Trailer/mp4/<?php echo $size; ?>/<?php echo $Video['id']; ?>.mp4'
						url: '<?php echo $url; ?>'
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
		<?php
	}
	?>
</div>

<?php if (!$this->Session->read('Auth.User.id') || (strtotime($this->Session->read('Auth.User.caducidad')) < time())): ?>
	<script>
	$(document).ready(function() {

		if ($('#_view_video').attr('var')) {
			var path = $('#_view_video').attr('var');
		} else {
			var path = '/users/register_popup/<?php echo $Video['slug']; ?>';
		}

		$.get(path, function(data) {
			$('#register_dialog').html(data);

			setTimeout(function() {
				if ($('.remaining').html()) {
					refresh($('.remaining').html());
					isCalling();
				}
			}, 1000);
		});

	});
	</script>
	<?php
endif; 
