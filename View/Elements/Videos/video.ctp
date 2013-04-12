<?php
$size = $mobileDevice?'s':'m';
$folder = explode('-', $main['Photo']['id']);
$folder = substr($folder[1], 0, 3);
$image = $this->Html->url('/img/Photo/' . $folder . '/' . $main['Photo']['id'] . ',fitCrop,964,542.jpg', array('class' => 'image', 'alt' => ''));
?>
<div class="player">
	<div class="player_video">
		<div class="flowplayer is-splash play-button" 
			<?php echo 'style="background-image:url('.$image.')"'; ?>
			data-swf="<?php echo $this->Html->url('/html5/flowplayer/flowplayer.swf'); ?>">
			<?php
			if ($this->Session->read('Auth.User.caducidad') > date('Y-m-d H:i:s')) {

				$link = Security::hash($this->Session->read('Auth.User.id') . '_' . $Video['id'], null, true);
				?>
				<video>
					<source type="video/mp4" src="<?php echo $this->Html->url('/links/' . $this->Session->read('Auth.User.id') . '/' . $link . '_mp4_m.mp4'); ?>"/>
					<source type='video/ogg; codecs="theora, vorbis"' src="<?php echo $this->Html->url('/links/' . $this->Session->read('Auth.User.id') . '/' . $link . '_ogg_m.ogg'); ?>"/>
				</video>
				<?php
			} else {
				?>
				<video>
					<source type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"' src="<?php echo $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']); ?>.mp4"/>
					<source type='video/ogg; codecs="theora, vorbis"' src="<?php echo $this->Html->url('/video/Trailer/ogg/'.$size.'/' . $Video['id']); ?>.ogg"/>
					<source type="video/flash" src="<?php echo $this->Html->url('/video/Trailer/flv/'.$size.'/' . $Video['id']); ?>.flv"/>
				</video>
				<?php
			}
			?>
		</div>
	</div>
</div>

<script>
	$(".flowplayer").flowplayer({
		tooltip: false,
		'key': '$397432013148639',
		'logo' : '<?php echo $this->Html->url('/img/logo.png', true); ?>'
	});
</script>
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
