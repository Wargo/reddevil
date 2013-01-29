<?php
$photos = classregistry::init('Photo')->getPhotos($Video['id'], 6);
$categories = ClassRegistry::init('VideoRelationship')->getCategories($Video['id']);
$actors = ClassRegistry::init('VideoRelationship')->getActors($Video['id']);

if (count($photos)) {
	?>
	<div class="block_photos">
		<div class="title"><?php echo $Video['title']; ?></div>
		<div class="photos">
			<?php
			foreach ($photos as $photo) {

				extract($photo);

				$alt = ClassRegistry::init('Photo')->getTitle($Photo);

				echo $this->Html->link($this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,317,200.jpg', array('alt' => $alt, 'title' => $alt)),
					array('controller' => 'videos', 'action' => 'view_photos', $Video['slug'], $Photo['id']),
					array('escape' => false));

			}
			?>
		</div>
		<div class="footer clearfix">
			<?php
			echo $this->Html->link(__('Ver el vídeo'), array('controller' => 'videos', 'action' => 'view', $Video['slug']), array('class' => 'see_video'));
			?>
			<p class="grey">
				<strong><?php echo __('Actores'); ?>:</strong>
				<?php
				$links = array();
				foreach ($actors as $actor_id => $actor_name) {
					$links[] = $this->Html->link($actor_name, array('controller' => 'videos', 'action' => 'home', 1, 'actor' => $actor_id));
				}
				echo implode(', ', $links);
				?>
			</p>
			<p class="grey">
				<strong><?php echo __('Categorías'); ?>:</strong>
				<?php
				$links = array();
				foreach ($categories as $category_id => $category_name) {
					$links[] = $this->Html->link($category_name, array('controller' => 'videos', 'action' => 'home', 1, 'category' => $category_id));
				}
				echo implode(', ', $links);
				?>
			</p>
		</div>
	</div>
	<?php
}
