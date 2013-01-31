<div class="profile clearfix">
	<div class="photo">
		<?php
		echo $this->Html->image('Actor/' . $Actor['id'] . ',fitInside,300,500.jpg', array());
		?>
	</div>
	<div class="info">
		<h1><?php echo $Actor['name']; ?></h1>
		<p><?php echo nl2br($Actor['description']); ?></p>
		<div class="photos">
			<?php
			if ($this->params['controller'] == 'videos') {
				$photos = ClassRegistry::init('Photo')->getPhotosByActor($Actor['id'], 6);
				foreach ($photos as $photo) {
					extract($photo);
					echo $this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,100,100.jpg', array());
				}
			}
			?>
		</div>
	</div>
	<?php
	if ($this->params['controller'] == 'photos') {
		echo $this->Html->link(__('Ver sus escenas'),
			array('controller' => 'videos', 'action' => 'home', 'page' => 1, 'actor' => $Actor['slug'], 'gender' => $Actor['gender']),
			array('class' => 'see_more_photos'));
	} else {
		echo $this->Html->link(__('Ver más fotos'),
			array('controller' => 'photos', 'action' => 'view', 'actor' => $Actor['slug'], 'page' => 1),
			array('class' => 'see_more_photos'));
	}
	?>
</div>
