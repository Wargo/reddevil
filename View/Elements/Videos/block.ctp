<?php
//$video_url = array('controller' => 'videos', 'action' => 'view', $Video['id']);
$video_url = array('controller' => 'videos', 'action' => 'view', $Video['slug']);
$categories = ClassRegistry::init('VideoRelationship')->getCategories($Video['id']);
$actors = ClassRegistry::init('VideoRelationship')->getActors($Video['id']);
?>
<div class="block_video">
	<div class="clearfix">
		<div class="main_photo">
			<?php echo $this->Html->link($this->Html->image('play.png', array('alt' => '')), $video_url, array('escape' => false, 'class' => 'play', 'title' => 'Ver vídeo')); ?>
			<?php
			$main = ClassRegistry::init('Photo')->find('first', array(
				'conditions' => array(
					'video_id' => $Video['id'],
					'main' => 1
				),
			));
			$alt = ClassRegistry::init('Photo')->getTitle($main['Photo']);
			echo $this->Html->image('Photo' . DS . $main['Photo']['id'] . ',fitCrop,680,404.jpg', array('class' => 'image', 'alt' => $alt, 'title' => $alt));
			?>
			<div class="info clearfix">
				<div>
					<?php echo $this->Html->link($Video['title'], $video_url, array('class' => 'title')); ?>
				</div>
				<div class="left">
					<!--<p class="grey"><strong><?php echo __('Puntuación'); ?>:</strong> <?php echo $Video['rating']; ?></p>-->
					<p class="grey"><strong><?php echo __('Actualizado el'); ?>:</strong> <?php echo date('d-m-Y', strtotime($Video['published'])); ?></p>
					<p class="grey"><strong><?php echo __('Duración'); ?>:</strong> <?php echo gmdate('H:i:s', $Video['duration']); ?></p>
				</div>
				<div class="right">
					<p class="grey">
						<strong><?php echo __('Actores'); ?>:</strong>
						<?php
						$links = array();
						foreach ($actors as $actor) {
							$links[] = $this->Html->link($actor['Actor']['name'], array('controller' => 'videos', 'action' => 'home', 'page' => 1, 'actor' => $actor['Actor']['slug'], 'gender' => $actor['Actor']['gender']));
						}
						echo implode(', ', $links);
						?>
					</p>
					<p class="grey">
						<strong><?php echo __('Categorías'); ?>:</strong>
						<?php
						$links = array();
						foreach ($categories as $category_id => $category_name) {
							$links[] = $this->Html->link($category_name, array('controller' => 'videos', 'action' => 'home', 'page' => 1, 'category' => $category_id));
						}
						echo implode(', ', $links);
						?>
					</p>
				</div>
			</div>
		</div>
		<div class="small_photos">
			<?php
			$images = ClassRegistry::init('Photo')->find('all', array(
				'conditions' => array(
					'video_id' => $Video['id'],
					'main' => 0,
					'featured' => 1,
				),
				'limit' => 3,
				'order' => array('rand()')
			));
			foreach ($images as $image) {
				extract($image);
				$alt = ClassRegistry::init('Photo')->getTitle($Photo);
				echo $this->Html->link($this->Html->image('Photo' . DS . $Photo['id'] . ',fitCrop,300,200.jpg', array('alt' => $alt, 'title' => $alt)), $video_url, array('escape' => false, 'title' => $alt));
			}
			?>
		</div>
	</div>
	<div class="footer clearfix">
		<?php echo $this->Html->link(__('Haz click aquí ver el vídeo completo', true), array('controller' => 'videos', 'action' => 'view_video', $Video['slug']), array('class' => 'suscribe')); ?>
		<?php
		//if (ClassRegistry::init('Video')->isPrivate($Video['id'], $cookies)) {
		if ($this->Session->read('Auth.User.caducidad') < date('Y-m-d H:i:s')) {
			echo '<span class="private">' . __('Privado') . '</span>';
		} else {
			echo '<span class="private public">' . __('Público') . '</span>';
		}
		?>
		<?php echo $this->Html->link(sprintf(__('Ver fotos (%s)'), ClassRegistry::init('Photo')->find('count', array('conditions' => array('video_id' => $Video['id'], 'Photo.active' => 1)))), array('controller' => 'videos', 'action' => 'view_photos', $Video['slug']), array('class' => 'num_photos')); ?>
	</div>
</div>
