<?php

?>
<div class="block_photos">
	<div class="title"><?php echo __('Actores y actrices de RedDevilX'); ?></div>
	<div class="photos">
		<?php
		foreach ($actors as $actor) {

			extract($actor);

			echo $this->Html->link($this->Html->image('Actor/' . $Actor['id'] . ',fitCrop,317,400.jpg', array('alt' => $Actor['name'], 'title' => $Actor['name'])),
				array('controller' => 'videos', 'action' => 'home', 'actor' => $Actor['slug'], 'gender' => $Actor['gender'], 'page' => 1),
				array('escape' => false));

		}
		?>
	</div>
</div>
