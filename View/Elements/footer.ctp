<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
<ul class="clearfix">
	<li><?php echo $this->Html->link(__('Vídeos'), array('controller' => 'videos', 'action' => 'home')); ?></li>
	<li><?php echo $this->Html->link(__('Fotos'), array('controller' => 'photos', 'action' => 'index')); ?></li>
	<li><?php echo $this->Html->link(__('Webcams', true), array('controller' => 'cams', 'action' => 'index'), array('class' => $this->params['controller'] == 'cams' ? 'selected' : '', 'title' => __('Webcams'))); ?></li>
	<li><?php echo $this->Html->link(__('Zona para webmasters'), 'http://www.webafiliacion.com', array('target' => '_blank')); ?></li>
	<li><?php echo $this->Html->link(__('Ser actriz porno'), array('controller' => 'pages', 'action' => 'display', 'wannabe')); ?></li>
	<li><?php echo $this->Html->link(__('Textos legales'), array('controller' => 'pages', 'action' => 'display', 'legal')); ?></li>
</ul>
