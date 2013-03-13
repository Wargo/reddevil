<div class="menu clearfix">
	<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
	<ul class="menu_buttons">
		<li><?php echo $this->Html->link(__('Vídeos', true), array('controller' => 'videos', 'action' => 'home'), array('class' => $this->params['controller'] == 'videos' ? 'selected' : '', 'title' => __('Vídeos'))); ?></li>
		<li><?php echo $this->Html->link(__('Fotos', true), array('controller' => 'photos', 'action' => 'index'), array('class' => $this->params['controller'] == 'photos' ? 'selected' : '', 'title' => __('Fotos'))); ?></li>
		<?php if (true || Configure::read('debug')) { ?>
			<li><?php echo $this->Html->link(__('Webcams', true), array('controller' => 'cams', 'action' => 'index'), array('class' => $this->params['controller'] == 'cams' ? 'selected' : '', 'title' => __('Webcams'))); ?></li>
		<?php } else { ?>
			<li><?php echo $this->Html->link(__('Webcams', true), array(), array('class' => 'disabled', 'title' => __('Webcams'))); ?></li>
		<?php } ?>
	</ul>
	<?php echo $this->element('follow'); ?>
	<?php echo $this->element('search'); ?>
</div>
