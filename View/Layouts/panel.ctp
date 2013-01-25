<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->fetch('css');

		echo $this->Html->script('js');
		echo $this->fetch('script');

		echo $this->fetch('meta');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><strong><?php echo __('Panel de control', true); ?></strong></h1>
			<ul class="menu">
				<li><?php echo $this->Html->link(__('Categorías', true), array('admin' => true, 'controller' => 'categories', 'action' => 'index'), array('class' => $this->params['controller'] == 'categories' ? 'selected' : '')); ?></li>
				<li><?php echo $this->Html->link(__('Actores/Actrices', true), array('admin' => true, 'controller' => 'actors', 'action' => 'index'), array('class' => $this->params['controller'] == 'actors' ? 'selected' : '')); ?></li>
				<li><?php echo $this->Html->link(__('Vídeos', true), array('admin' => true, 'controller' => 'videos', 'action' => 'index'), array('class' => $this->params['controller'] == 'videos' ? 'selected' : '')); ?></li>
				<li><?php echo $this->Html->link(__('Archivos subidos', true), array('admin' => true, 'controller' => 'archivos', 'action' => 'index'), array('class' => $this->params['controller'] == 'archivos' ? 'selected' : '')); ?></li>
				<li><?php echo $this->Html->link(__('Fotos', true), array('admin' => true, 'controller' => 'photos', 'action' => 'index'), array('class' => $this->params['controller'] == 'photos' ? 'selected' : '')); ?></li>
			</ul>
		</div>
		<div id="content">
			<div class="bg_header"></div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
