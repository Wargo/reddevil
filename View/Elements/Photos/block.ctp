<div class="block_photos">
	<div class="title"><?php echo $Video['title']; ?></div>
	<div class="photos">
		<?php
		$photos = classregistry::init('Photo')->getPhotos($Video['id']);

		foreach ($photos as $photo) {

			extract($photo);

			echo $this->Html->link($this->Html->image('screenshots/3,fitCrop,317,200.jpg', array()),
				array('controller' => 'videos', 'action' => 'view_photos', $Video['id']),
				array('escape' => false));

		}
		?>
	</div>
</div>
