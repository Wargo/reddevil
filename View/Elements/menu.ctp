<div class="menu clearfix">
	<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
	<ul class="menu_buttons">
		<li><?php echo $this->Html->link(__('Vídeos'), array('controller' => 'videos', 'action' => 'home'), array('class' => $this->params['controller'] == 'videos' ? 'selected' : '', 'title' => __('Vídeos'))); ?></li>
		<li><?php echo $this->Html->link(__('Fotos'), array('controller' => 'photos', 'action' => 'index'), array('class' => $this->params['controller'] == 'photos' ? 'selected' : '', 'title' => __('Fotos'))); ?></li>
		<li><?php echo $this->Html->link(__('Webcams'), array('controller' => 'cams', 'action' => 'index'), array('class' => $this->params['controller'] == 'cams' ? 'selected' : '', 'title' => __('Webcams'))); ?></li>
		<?php if (true) { //  Configure::read('debug')) { ?>
			<li><?php echo $this->Html->link(__('Tu cuenta'), array('controller' => 'users', 'action' => 'profile'), array('class' => $this->params['controller'] == 'users' ? 'selected' : 'go_my_profile', 'title' => __('Tu cuenta'))); ?></li>
		<?php } else { ?>
			<li><?php echo $this->Html->link(__('Tu cuenta'), array(), array('class' => 'disabled', 'title' => __('Tu cuenta'))); ?></li>
		<?php } ?>
	</ul>
	<?php echo $this->element('search'); ?>
	<?php //echo $this->element('Users/top_login'); ?>
	<?php echo $this->element('follow'); ?>
</div>
