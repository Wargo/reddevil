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
		echo $this->Html->meta('icon');

		echo $this->Html->css('styles');
		echo $this->fetch('css');

		echo $this->Html->script('js');
		echo $this->fetch('script');

		echo $this->fetch('meta');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<div class="menu">
				<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
				<ul>
					<li><?php echo $this->Html->link(__('Vídeos', true), array(), array('title' => __('Vídeos', true))); ?></li>
					<li><?php echo $this->Html->link(__('Chicas', true), array(), array('title' => __('Chicas', true))); ?></li>
					<li><?php echo $this->Html->link(__('Fotos', true), array(), array('title' => __('Fotos', true))); ?></li>
				</ul>
			</div>
		</div>
		<div id="content">
			<div class="bg_header"></div>
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
			<div id="footer">
				<?php echo $this->Html->link($this->Html->image('logo.png', array('alt' => 'logo')), '/', array('escape' => false, 'title' => __('Red Devil', true), 'class' => 'logo')); ?>
				<ul class="clearfix">
					<li><?php echo $this->Html->link(__('Vídeos', true), array()); ?></li>
					<li><?php echo $this->Html->link(__('Chicas', true), array()); ?></li>
					<li><?php echo $this->Html->link(__('Escenas', true), array()); ?></li>
					<li><?php echo $this->Html->link(__('Zona para webmasters', true), array()); ?></li>
					<li><?php echo $this->Html->link(__('Castings', true), array()); ?></li>
					<li><?php echo $this->Html->link(__('Versión móvil', true), array()); ?></li>
				</ul>
			</div>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
