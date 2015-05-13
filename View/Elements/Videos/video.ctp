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
		$('#flash_player').html('<div class="no_flash_detected"><?php echo __('Parece que no dispones del flash player, puedes descargártelo %s', $this->Html->link(__('aquí'), 'http://www.adobe.com/go/getflashplayer', array('target' => '_blank'))); ?></div>');
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
			
			if(USE_STREAMING){
				$url = 'links/' . $this->Session->read('Auth.User.id') . '/' . $link . '_flv_m.flv';
			}
			else{
				$url = 'http://www.reddevilx.com' . $this->Html->url('/links/' . $this->Session->read('Auth.User.id') . '/' . $link . '_flv_m.flv');
			}

		} else {

			if(USE_STREAMING){
				$url = 'Trailer/flv/'.$size.'/' . $Video['id'] . '.flv';
			}
			else{
				$url = 'http://www.reddevilx.com' . $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']) . '.mp4';
			}

		}
		if (false && $Video['id'] == '519b2590-2efc-4806-83e0-16bcbca5e1a6') {
			//$url = 'http://www.reddevilx.com' . $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']) . '.mp4';
			$url = 'Trailer/mp4/'.$size.'/' . $Video['id'] . '.mp4';
			?>
			<script>
				$(document).ready(function() {
					$('#dialog').html('<h2 style="margin:20px;">Lo sentimos, la escena completa no estará disponible hasta dentro de unas horas</h2>');
					$('#dialog').dialog({
						width: 500,
						modal: true,
						buttons: {
							Ok: function() {
								$(this).dialog('close');
							}
						},
					});
				});
			</script>
			<?php
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
						<?php if(USE_STREAMING):?>
						provider:'hddn',
						<?php endif;?>
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
		<?php
	}
	?>
</div>

<?php if (!$this->Session->read('Auth.User.id') || (strtotime($this->Session->read('Auth.User.caducidad')) < time())): ?>
	<script>
	$(document).ready(function() {
		load_popup();
	});
	</script>
<?php endif; 

	//echo $this->element('payment_popup');
/* if (ClassRegistry::init('Video')->isPrivate($Video['id'], $cookies)) {
	?>
	<div class="hidden" id="dialog-message" title="<?php echo __('Ver el vídeo completo'); ?>">
		<div id="tabs">
			<ul>
				<li><a href="#fragment-1"><span><?php echo __('Teléfono'); ?></span></a></li>
				<li><a href="#fragment-2"><span><?php echo __('SMS'); ?></span></a></li>
				<?php
				if (Configure::read('debug')) {
					?>
					<li><a href="#fragment-3"><span><?php echo __('Registro'); ?></span></a></li>
					<?php
				}
				?>
			</ul>
			<div id="fragment-1">
				<div class="pay">
					<?php echo sprintf(__('Llama al %s, tienes %s segundos para llamar'), '<span class="big" id="phone">' . $phone . '</span>', '<span class="remaining">' . $total_seconds . '</span>'); ?>
					<p class="info_text"><?php echo Configure::read('info_m'); ?></p>
				</div>
			</div>
			<div id="fragment-2">
				<div class="sms">
					<?php echo sprintf(__('Envía %s al %s, dispones de %s segundos para mandarlo'), '<span class="big">' . $text . '</span>', '<span class="big">' . $sms . '</span>', '<span class="remaining">' . $total_seconds . '</span>'); ?>
					<p class="info_text"><?php echo Configure::read('info_m'); ?></p>
				</div>
			</div>
			<?php
			if (Configure::read('debug')) {
				?>
				<div id="fragment-3">
					<div class="register">
					<?php echo $this->element('Users/register', array('video_id' => $Video['id'])); ?>
					</div>
				</div>
				<?php
			} 
			?>
		</div>
		<script>
			$( "#tabs" ).tabs();
		</script>
	</div>
	<?php
} */
