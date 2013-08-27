<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script> 
	<?php
	$this->Asset->css(array('styles', 'glassman', 'forms'));
	echo $this->Html->meta('icon');
	echo $this->Asset->out('css');	
	echo $this->element('meta');
	?>
</head>
<body>
	<?php echo $this->element('wallpaper'); ?>
	<div id="container">
		<a class="logo_glassman" href="http://www.glassmanproject.com/"><img alt="Glassman Project" src="http://www.glassmanproject.com/wp-content/uploads/2013/05/logofinalsiosi.png"></a>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
	<div class="hidden" id="dialog"></div>
	<div class="hidden clearfix" id="register_dialog"></div>
	<?php
	echo $this->element('js'); 
	echo $this->element('analytics'); 
	?>
</body>
</html>
