<script type="text/javascript">
$(function() {
	$.scrollTo('#buttons', 200, {offset:{top:-100}});
});
</script>
<div class="clearfix">
	<div class="featured">
		<?php
		$num_photos = ClassRegistry::init('Photo')->find('count', array('conditions' => array('video_id' => $Video['id'], 'Photo.active' => 1)));

		$ad1 = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id !=' => $Video['id'],
				'adv' => 1,
				'Video.active' => 1
			),
			'order' => ('rand()'),
		));
		$slug1 = ClassRegistry::init('Video')->getSlug($ad1['Photo']['video_id']);
		$ad2 = ClassRegistry::init('Photo')->find('first', array(
			'conditions' => array(
				'video_id !=' => $Video['id'],
				'featured' => 1,
				'Video.active' => 1
			),
			'order' => ('rand()'),
		));
		$slug2 = ClassRegistry::init('Video')->getSlug($ad2['Photo']['video_id']);

		$alt = ClassRegistry::init('Photo')->getTitle($ad1['Photo']);
		echo $this->Html->link($this->Html->image('Photo/' . $ad1['Photo']['id'] . ',fitCrop,750,260.jpg', array('alt' => $alt, 'title' => $alt)), array('controller' => 'videos', 'action' => 'view', $slug1), array('escape' => false, 'class' => 'image'));
		?>
		<ul class="buttons" id="buttons">
			<li><?php echo $this->Html->link(__('Ver vídeo', true), array('controller' => 'videos', 'action' => 'view_video', $Video['slug']), array('id' => 'view_video', 'class' => '_view_video ' . ($section == 'video' ? 'selected' : ''))); ?></li>
			<li><?php echo $this->Html->link(__('Ver trailer', true), array('controller' => 'videos', 'action' => 'view', $Video['slug']), array('id' => 'view_trailer', 'class' => '_view_trailer ' . ($section == 'trailer' ? 'selected' : ''))); ?></li>
			<li><?php echo $this->Html->link(sprintf(__('Ver fotos (%d)'), $num_photos), array('controller' => 'videos', 'action' => 'view_photos', $Video['slug']), array('id' => 'view_photos', 'class' => '_view_photos ' . ($section == 'photos' ? 'selected' : ''))); ?></li>
			<li><?php echo $this->Html->link($this->Html->image('share.png', array('width' => 20, 'align' => 'left')) .  __('Compartir'), array('controller' => 'videos', 'action' => 'share', $Video['id']), array('id' => 'view_photos', 'class' => '_share', 'escape' => false)); ?></li>
		</ul>
	</div>

	<div class="promo">
		<p class="title"><?php echo __('¿Quieres ver este vídeo?', true); ?></p>
		<?php
		$alt = ClassRegistry::init('Photo')->getTitle($ad2['Photo']);
		echo $this->Html->link($this->Html->image('Photo/' . $ad2['Photo']['id'] . ',fitCrop,200,180.jpg', array('alt' => $alt, 'title' => $alt)), array('controller' => 'videos', 'action' => 'view', $slug2), array('escape' => false, 'class' => 'image'));
		?>
	</div>
</div>
<div class="video">
	<h1><?php echo $title_for_layout; ?></h1>
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
		<li><?php
		if (ClassRegistry::init('Video')->isPrivate($Video['id'], $cookies)) {
			echo $this->Html->link(__('Bájate el vídeo completo'),
				array('controller' => 'videos', 'action' => 'view_video', $Video['slug']),
				array('class' => '_view_video'));
		} else {
			echo $this->Html->link(__('Bájate el vídeo completo'),
				array('controller' => 'videos', 'action' => 'download', $Video['id']),
				array('class' => '_download_video'));
		}
		?></li>
		<li><?php echo $this->Html->link(__('Ver el vídeo completo') . $this->Html->image('mini_play.png', array('align' => 'absmiddle')), array('controller' => 'videos', 'action' => 'view_video', $Video['slug']), array('escape' => false, 'class' => '_view_video with_image')); ?></li>
		<li><?php echo $this->Html->link(sprintf(__('Fotos (%s)'), $num_photos), array('controller' => 'videos', 'action' => 'view_photos', $Video['id']), array('class' => '_view_photos')); ?></li>
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
		$alt = ClassRegistry::init('Photo')->getTitle($Photo);
		echo $this->Html->image('Photo' . DS . $Photo['id'] . ',fitCrop,239,150.jpg', array('alt' => $alt, 'title' => $alt));
	}
	?>
</div>
<div class="separator clearfix">
	<div class="arrow">
		<?php echo __('Ver escena entera ahora'); ?>
	</div>
	<div class="text">
		<?php echo __('Descarga o visualízala en alta definición'); ?>
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
			'order' => array('rand()'),
			'fields' => array('id', 'title', 'slug')
		));
		foreach ($others as $other) {
			//$video = ClassRegistry::init('Video')->findById($other['Photo']['video_id']);
			$photo = ClassRegistry::init('Photo')->find('first', array(
				'conditions' => array('video_id' => $other['Video']['id'], 'main' => 0, 'Photo.active' => 1),
				'order' => array('rand()'),
			));
			$alt = ClassRegistry::init('Photo')->getTitle($photo['Photo']);
			?>
			<div class="photo">
				<?php echo $this->Html->link($this->Html->image('Photo/' . $photo['Photo']['id'] . ',fitCrop,312,280.jpg', array('alt' => $alt, 'title' => $alt)), array('controller' => 'videos', 'action' => 'view', $other['Video']['slug']), array('escape' => false)); ?>
				<div class="info">
					<p><strong><?php echo $other['Video']['title']; ?></strong></p>
					<p><?php echo __('Haz click para acceder al vídeo completo'); ?></p>
				</div>
			</div>
			<?php
		}
		?>
	</div>
	<?php echo $this->Html->link(__('Más vídeos', true), array(), array('class' => 'more_videos_button')); ?>
</div>
<div class="hidden" id="dialog"></div>
