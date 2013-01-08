<div class="clearfix">
	<div class="featured">
		<?php echo $this->Html->link($this->Html->image('screenshots/5.jpg', array('alt' => 'Vídeo')), array(), array('escape' => false, 'class' => 'image')); ?>
		<ul class="buttons">
			<li><?php echo $this->Html->link(__('Ver vídeo', true), array()); ?></li>
			<li><?php echo $this->Html->link(__('Ver trailer', true), array()); ?></li>
			<li><?php echo $this->Html->link(__('Ver fotos (12)', true), array()); ?></li>
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
		<?php echo $this->Html->link($this->Html->image('play.png', array('alt' => '')), array(), array('escape' => false, 'class' => 'play', 'title' => 'Ver vídeo')); ?>
		<?php echo $this->Html->image('screenshots/6.jpg', array('alt' => 'Vídeo', 'class' => 'preview')); ?>
	</div>
</div>
