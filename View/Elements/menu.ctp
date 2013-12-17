<div class="menu clearfix">
	<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
	<ul class="menu_buttons">
		<li><?php echo $this->Html->link(__('Vídeos'), array('controller' => 'videos', 'action' => 'home'), array('class' => $this->params['controller'] == 'videos' && $this->params['action'] == 'home' ? 'selected' : '', 'title' => __('Vídeos'))); ?></li>
		<li><?php echo $this->Html->link(__('Fotos'), array('controller' => 'photos', 'action' => 'index'), array('class' => $this->params['controller'] == 'photos' ? 'selected' : '', 'title' => __('Fotos'))); ?></li>
		<li><?php echo $this->Html->link(__('Webcams'), array('controller' => 'cams', 'action' => 'index'), array('class' => $this->params['controller'] == 'cams' ? 'selected' : '', 'title' => __('Webcams'))); ?></li>
		<li><?php echo $this->Html->link(__('Sitios'), array('controller' => 'videos', 'action' => 'sites'), array('class' => $this->params['controller'] == 'videos' && $this->params['action'] == 'sites' ? 'selected' : '', 'title' => __('Webcams'))); ?></li>
		<?php
		if ($this->Session->read('Auth.User.id')) {
			$text = __('Tu cuenta');
		} else {
			$text = __('Hazte socio');
		}
		?>
		<li><?php echo $this->Html->link($text, 
			array('controller' => 'users', 'action' => 'profile'), 
			array('class' => $this->params['controller'] == 'users' ? 'selected' : 'go_my_profile', 'title' => $text, 'id' => 'link_socio')); ?></li>
	</ul>
	<?php echo $this->element('search'); ?>
</div>
