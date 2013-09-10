<div class="girls_page clearfix">
	<div class="title"><?php echo __('Chicas'); ?></div>
	<div class="photos">
		<?php
		foreach ($actors as $actor) {

			extract($actor);

			echo '<div class="girl">';

			echo $this->Html->link($this->Html->image('Actor/' . $Actor['id'] . ',fitCrop,243,320.jpg', array('alt' => $Actor['name'], 'title' => $Actor['name'])),
				array('controller' => 'videos', 'action' => 'home', 'actor' => $Actor['slug'], 'gender' => $Actor['gender'], 'page' => 1),
				array('escape' => false));

			echo '<span class="name">' . $Actor['name'] . '</span>';

			echo '</div>';

		}
		?>
	</div>
</div>
