<div class="profile clearfix">
	<div class="photo">
		<?php
		echo $this->Html->image('Actor/' . $Actor['id'] . ',fitInside,300,500.jpg', array());
		?>
	</div>
	<div class="info">
		<h1><?php echo $Actor['name']; ?></h1>
		<p><?php echo $Actor['description']; ?></p>
		<div class="photos">
			<?php
			$photos = ClassRegistry::init('Photo')->getPhotosByActor($Actor['id'], 6);
			foreach ($photos as $photo) {
				extract($photo);
				echo $this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,100,100.jpg', array());
			}
			?>
		</div>
	</div>
</div>
