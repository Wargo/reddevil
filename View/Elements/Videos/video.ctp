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
			<?php
			if (!empty($cookies[$Video['id']])) {
				?>
				<video>
					<source type="video/mp4" src="<?php echo $this->Html->url('/links/' . $cookies['user'] . '/' . $cookies[$Video['id']] . '_mp4_l'); ?>"/>
				</video>
				<?php
			} else {
				?>
				<video>
					<source type='video/mp4; codecs="avc1.4D401E, mp4a.40.2"' src="<?php echo $this->Html->url('/video/Trailer/mp4/'.$size.'/' . $Video['id']); ?>.mp4"/>
				</video>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php if ($this->request->is('ajax')): ?>
<script>
	$(".flowplayer").flowplayer({});
</script>
<?php endif; ?>

<?php
if (ClassRegistry::init('Video')->isPrivate($Video['id'], $cookies)) {
	?>
	<div class="hidden" id="dialog-message" title="<?php echo __('Ver el vídeo completo'); ?>">
		<div id="tabs">
			<ul>
				<li><a href="#fragment-1"><span><?php echo __('Teléfono'); ?></span></a></li>
				<li><a href="#fragment-2"><span><?php echo __('SMS'); ?></span></a></li>
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
		</div>
		<script>
			$( "#tabs" ).tabs();
		</script>
	</div>
	<?php
}
