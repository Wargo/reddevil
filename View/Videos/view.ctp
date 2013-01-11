<div class="clearfix">
	<div class="featured">
		<?php echo $this->Html->link($this->Html->image('screenshots/5,fitCrop,750,260.jpg', array('alt' => 'Vídeo')), array(), array('escape' => false, 'class' => 'image')); ?>
		<a name="anchor"></a>
		<ul class="buttons">
			<li><?php echo $this->Html->link(__('Ver vídeo', true), array(), array('id' => 'view_video', 'class' => $section == 'video' ? 'selected' : '')); ?></li>
			<li><?php echo $this->Html->link(__('Ver trailer', true), array('controller' => 'videos', 'action' => 'view', $Video['id']), array('id' => 'view_trailer', 'class' => '_view_trailer ' . ($section == 'trailer' ? 'selected' : ''))); ?></li>
			<li><?php echo $this->Html->link(sprintf(__('Ver fotos (%d)'), 12), array('controller' => 'videos', 'action' => 'view_photos', $Video['id']), array('id' => 'view_photos', 'class' => '_view_photos ' . ($section == 'photos' ? 'selected' : ''))); ?></li>
		</ul>
	</div>
	<div class="promo">
		<p class="title"><?php echo __('¿Quieres ver este vídeo?', true); ?></p>
		<p class="send"><?php printf(__('Envía %s al %d'), 'GATITO', 1234); ?></p>
		<?php echo $this->Html->link($this->Html->image('screenshots/2,fitCrop,200,133.jpg', array('alt' => 'Vídeo')), array(), array('escape' => false, 'class' => 'image')); ?>
	</div>
</div>
<div class="video">
	<h1><?php echo $Video['title']; ?></h1>
	<div id="section">
		<?php
		switch ($section) {
			case 'photos':
				echo $this->element('Videos/photos', compact('Video'));
				break;
			case 'trailer':
				echo $this->element('Videos/player', compact('Video'));
				break;
		}
		?>
	</div>
</div>
<div class="video_footer">
	<ul>
		<li><?php echo $this->Html->link(__('Bájate el vídeo completo', true), array()); ?></li>
		<li><?php echo $this->Html->link(__('Ver el vídeo completo', true) . $this->Html->image('mini_play.png', array('align' => 'absmiddle')), array(), array('escape' => false, 'class' => 'with_image')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Fotos (%d)'), 12), array('controller' => 'videos', 'action' => 'view_photos', $Video['id']), array('class' => '_view_photos')); ?></li>
	</ul>
</div>
