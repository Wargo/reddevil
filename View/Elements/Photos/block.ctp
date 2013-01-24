<?php
$photos = classregistry::init('Photo')->getPhotos($Video['id']);

if (count($photos)) {
	?>
	<div class="block_photos">
		<div class="title"><?php echo $Video['title']; ?></div>
		<div class="photos">
			<?php
			foreach ($photos as $photo) {

				extract($photo);

				echo $this->Html->link($this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,317,200.jpg', array()),
					array('controller' => 'videos', 'action' => 'view_photos', $Video['id'], $Photo['id']),
					array('escape' => false));

			}
			?>
		</div>
	</div>
	<?php
}
