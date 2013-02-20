<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 
	<script src="http://flesler-plugins.googlecode.com/files/jquery.scrollTo-1.4.3.1.js"></script> 
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('styles');
		echo $this->Html->css('forms');
		echo $this->Html->css('flowplayer/minimalist');
		echo $this->Html->css('lightbox/jquery.lightbox-0.5');
		
		echo $this->fetch('css');

		echo $this->element('js');
		echo $this->element('meta');

		//echo $this->fetch('script');
		//echo $this->fetch('meta');
	?>
	<?php echo $this->element('analytics'); ?>
</head>
<body>
	<div id="container">
		<div id="header">
			<?php echo $this->element('menu'); ?>
		</div>
		<div id="content">
			<div class="bg_header"></div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<div id="footer">
				<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
				<ul class="clearfix">
					<li><?php echo $this->Html->link(__('Vídeos'), array('controller' => 'videos', 'action' => 'home')); ?></li>
					<li><?php echo $this->Html->link(__('Fotos'), array('controller' => 'photos', 'action' => 'index')); ?></li>
					<li><?php echo $this->Html->link(__('Webcams'), array(), array('class' => 'disabled')); ?></li>
					<li><?php echo $this->Html->link(__('Zona para webmasters'), 'http://www.webafiliacion.com', array('target' => '_blank')); ?></li>
					<li><?php echo $this->Html->link(__('Ser actriz porno'), array('controller' => 'pages', 'action' => 'display', 'wannabe')); ?></li>
					<li><?php echo $this->Html->link(__('Versión móvil'), array(), array('class' => 'disabled')); ?></li>
				</ul>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->element('feedback'); ?>
	<div class="hidden" id="dialog"></div>
</body>
</html>
