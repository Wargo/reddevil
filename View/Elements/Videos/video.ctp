<div class="player">
	<div class="player_video">
		<div class="flowplayer is-splash" 
			<?php echo 'style="background-image:url('.$this->Html->url('/img/screenshots/6,fitCrop,964,542.jpg').')"'; ?>
			data-swf="<?php echo $this->Html->url('/html5/flowplayer/flowplayer.swf'); ?>">
			<video>
				<source type="video/mp4" src="<?php echo $this->Html->url('/flash/trailers/video.mp4'); ?>"/>
			</video>
		</div>
	</div>
</div>
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
			<p id="isCalling_phone">result</p>
		</div>
		<div id="fragment-2">
			<div class="sms">
				<?php echo sprintf(__('Envía %s al %s, dispones de %s segundos para mandarlo'), '<span class="big">' . $text . '</span>', '<span class="big">' . $sms . '</span>', '<span class="remaining">' . $total_seconds . '</span>'); ?>
				<p class="info_text"><?php echo Configure::read('info_m'); ?></p>
			</div>
			<p id="isCalling_sms">result</p>
		</div>
	</div>
	<script>
	$( "#tabs" ).tabs();
	</script>
</div>
