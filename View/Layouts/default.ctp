<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<link href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.0/themes/base/jquery-ui.css" />
	<link rel="stylesheet" href="http://releases.flowplayer.org/5.3.2/skin/minimalist.css" />
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<?php
		echo $this->Html->meta('icon');

		$this->Asset->css(array('styles', 'forms', 'lightbox/jquery.lightbox-0.5'));	
		if ($this->request->params['controller'] == 'cams') {
			$this->Asset->css(array('cams', 'colorbox'));
			$this->Asset->js(array('colorbox', 'colorbox-es'));
		}
		echo $this->Asset->out('css');	


		echo $this->element('meta');

	?>
</head>
<body>
	<?php echo $this->element('wallpaper'); ?>
	<div id="container">
		<div id="header">
			<?php echo $this->element('menu'); ?>
		</div>
		<div id="content">
			<div class="bg_header"></div>
			<?php //echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<?php echo $this->element('follow'); ?>
		</div>
		<div id="footer">
			<?php echo $this->element('footer'); ?>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<?php echo $this->element('feedback'); ?>
	<div class="hidden" id="dialog"></div>
	<div class="hidden clearfix" id="register_dialog"></div>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 
	<script src="http://flesler-plugins.googlecode.com/files/jquery.scrollTo-1.4.3.1.js"></script> 
	<?php
	echo $this->element('js');
	echo $this->element('analytics'); 
	?>
</body>
</html>
