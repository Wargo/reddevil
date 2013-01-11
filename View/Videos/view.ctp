<div class="clearfix">
	<div class="featured">
		<?php echo $this->Html->link($this->Html->image('screenshots/5.jpg', array('alt' => 'Vídeo')), array(), array('escape' => false, 'class' => 'image')); ?>
		<ul class="buttons">
			<li><?php echo $this->Html->link(__('Ver vídeo', true), array()); ?></li>
			<li><?php echo $this->Html->link(__('Ver trailer', true), array(), array('class' => 'selected')); ?></li>
			<li><?php echo $this->Html->link(sprintf(__('Ver fotos (%d)'), 12), array()); ?></li>
		</ul>
	</div>
	<div class="promo">
		<p class="title"><?php echo __('¿Quieres ver este vídeo?', true); ?></p>
		<p class="send"><?php printf(__('Envía %s al %d'), 'GATITO', 1234); ?></p>
		<?php echo $this->Html->link($this->Html->image('screenshots/2.jpg', array('alt' => 'Vídeo')), array(), array('escape' => false, 'class' => 'image')); ?>
	</div>
</div>
<div class="video">
	<h1><?php echo $Video['title']; ?></h1>
	<div class="player">


		<?php 
			echo $this->Html->link(
				$this->Html->image('screenshots/6.jpg', array('alt' => 'Vídeo', 'class' => 'preview')),
				'/flash/trailers/video.flv',
				array('id' => 'player', 'class' => 'preview', 'escape' => false)
			);
		?>
		<script>
			flowplayer("player", "/flash/flowplayer/flowplayer.swf", {
					clip: {
						autoPlay: true,
					}
				});
		</script>
	</div>
</div>
<div class="video_footer">
	<ul>
		<li><?php echo $this->Html->link(__('Bájate el vídeo completo', true), array()); ?></li>
		<li><?php echo $this->Html->link(__('Ver el vídeo completo', true) . $this->Html->image('mini_play.png', array('align' => 'absmiddle')), array(), array('escape' => false, 'class' => 'with_image')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Fotos (%d)'), 12), array()); ?></li>
	</ul>
</div>
