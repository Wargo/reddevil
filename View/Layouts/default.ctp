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
	<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	<?php
		echo $this->Html->meta('icon');

		//echo $this->Html->css('styles');
		echo $this->Html->css('styles2');
		echo $this->Html->css('forms');
		echo $this->Html->css('flowplayer/minimalist');
		echo $this->Html->css('lightbox/jquery.lightbox-0.5');

		if ($this->request->params['controller'] == 'cams') {
			echo $this->Html->css('cams');
			echo $this->Html->css('colorbox');
			echo $this->Html->script('colorbox');
			echo $this->Html->script('colorbox-es');
		}
		
		echo $this->fetch('css');

		echo $this->element('js');
		echo $this->element('meta');

		//echo $this->fetch('script');
		//echo $this->fetch('meta');
	?>
	<?php echo $this->element('analytics'); ?>
</head>
<body>
	<?php echo $this->Html->link($this->Html->image('bg/fallera.png', array()),
		array('controller' => 'videos', 'action' => 'view', 'pablo-ferrari-y-julia-de-lucia-en-fallas-o-follas-valencia-en-fallas'),
		array('class' => 'bg_promo', 'escape' => false)); ?>
	<div id="container">
		<div id="header">
			<?php echo $this->element('menu'); ?>
		</div>
		<div id="content">
			<div class="bg_header"></div>
			<?php //echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->element('footer'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->element('feedback'); ?>
	<div class="hidden" id="dialog"></div>
	<div class="hidden clearfix" id="register_dialog"></div>
</body>
</html>
