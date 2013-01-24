<div class="clearfix">
	<div class="featured">
		<?php
		$ad1 = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id !=' => $Video['id'],
				'main' => 0,
				'adv' => 1,
				'Video.active' => 1
			),
			'order' => ('rand()'),
		));
		$ad2 = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id !=' => $Video['id'],
				'main' => 0,
				'adv' => 0,
				'featured' => 1,
				'Video.active' => 1
			),
			'order' => ('rand()'),
		));
		echo $this->Html->link($this->Html->image('Photo/' . $ad1['Photo']['id'] . ',fitCrop,750,260.jpg', array('alt' => '')), array('controller' => 'videos', 'action' => 'view', $ad1['Photo']['video_id']), array('escape' => false, 'class' => 'image'));
		?>
		<ul class="buttons" id="buttons">
			<li><?php echo $this->Html->link(__('Ver vídeo', true), array('controller' => 'videos', 'action' => 'view_video', $Video['id']), array('id' => 'view_video', 'class' => '_view_video ' . ($section == 'video' ? 'selected' : ''))); ?></li>
			<li><?php echo $this->Html->link(__('Ver trailer', true), array('controller' => 'videos', 'action' => 'view', $Video['id']), array('id' => 'view_trailer', 'class' => '_view_trailer ' . ($section == 'trailer' ? 'selected' : ''))); ?></li>
			<li><?php echo $this->Html->link(sprintf(__('Ver fotos (%d)'), 12), array('controller' => 'videos', 'action' => 'view_photos', $Video['id']), array('id' => 'view_photos', 'class' => '_view_photos ' . ($section == 'photos' ? 'selected' : ''))); ?></li>
		</ul>
	</div>
	<div class="promo">
		<p class="title"><?php echo __('¿Quieres ver este vídeo?', true); ?></p>
		<p class="send"><?php printf(__('Envía %s al %d'), 'REDDEVIL', 6969); ?></p>
		<?php echo $this->Html->link($this->Html->image('Photo/' . $ad2['Photo']['id'] . ',fitCrop,200,133.jpg', array('alt' => '')), array('controller' => 'videos', 'action' => 'view', $ad2['Photo']['video_id']), array('escape' => false, 'class' => 'image')); ?>
	</div>
</div>
<div class="video">
	<h1><?php echo $Video['title']; ?></h1>
	<div id="section">
		<?php
		switch ($section) {
			case 'video':
				echo $this->element('Videos/video', compact('Video'));
				break;
			case 'photos':
				echo $this->element('Videos/photos', compact('Video'));
				break;
			case 'trailer':
				echo $this->element('Videos/player', compact('Video'));
				break;
		}
		?>

	</div>
</div>
<div class="video_footer">
	<ul>
		<li><?php echo $this->Html->link(__('Bájate el vídeo completo', true), array()); ?></li>
		<li><?php echo $this->Html->link(__('Ver el vídeo completo', true) . $this->Html->image('mini_play.png', array('align' => 'absmiddle')), array('controller' => 'videos', 'action' => 'view_video', $Video['id']), array('escape' => false, 'class' => '_view_video with_image')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Fotos (%d)'), 12), array('controller' => 'videos', 'action' => 'view_photos', $Video['id']), array('class' => '_view_photos')); ?></li>
	</ul>
</div>
<div class="preview_photos">
	<?php
	$images = ClassRegistry::init('Photo')->find('all', array(
		'conditions' => array(
			'video_id' => $Video['id'],
			'main' => 0
		),
		'limit' => 4,
		'order' => array('rand()')
	));
	foreach ($images as $image) {
		extract($image);
		echo $this->Html->image('Photo' . DS . $Photo['id'] . ',fitCrop,239,150.jpg', array('alt' => ''));
	}
	?>
</div>
<div class="separator clearfix">
	<div class="arrow">
		Ver escena entera ahora
	</div>
	<div class="text">
		Descarga o visualízala en alta definición
	</div>
</div>
<div class="more_videos">
	<div class="photos clearfix">
		<?php
		$others = ClassRegistry::init('Video')->find('all', array(
			'conditions' => array(
				'id !=' => $Video['id'],
				'Video.active' => 1
			),
			'limit' => 3,
			'fields' => array('id', 'title')
		));
		foreach ($others as $other) {
			//$video = ClassRegistry::init('Video')->findById($other['Photo']['video_id']);
			$photo = ClassRegistry::init('Photo')->find('first', array(
				'conditions' => array('video_id' => $other['Video']['id'], 'main' => 0, 'Photo.active' => 1),
				'order' => array('rand()'),
			));
			?>
			<div class="photo">
				<?php echo $this->Html->link($this->Html->image('Photo/' . $photo['Photo']['id'] . ',fitCrop,312,280.jpg', array('alt' => '')), array('controller' => 'videos', 'action' => 'view', $photo['Photo']['video_id']), array('escape' => false)); ?>
				<div class="info">
					<p><strong><?php echo $other['Video']['title']; ?></strong></p>
					<p>Haz click para acceder al vídeo completo</p>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php echo $this->Html->link(__('Más vídeos', true), array(), array('class' => 'more_videos_button')); ?>
</div>
