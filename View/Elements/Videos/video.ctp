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
<div id="dialog-message" title="<?php echo __('Ver el vídeo completo'); ?>">
	<div class="pay">
		<?php echo sprintf(__('Llama al %s, tienes %s segundos para llamar'), '<span id="phone">' . $phone . '</span>', '<span id="remaining">90</span>'); ?>
		<p class="info_text"><?php echo __('Servicio exclusivamente para aadultos prestado por Sistemas de Micropago, Sl. Apdo. de Correos 14.953 - 28080 Madrid. Cte. 1.45€/llamada desde fijo y 2€/llamada desde móvil I.V.A incluido.'); ?></p>
	</div>
</div>
