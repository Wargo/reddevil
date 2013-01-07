<div class="block_video clearfix">
	<div class="main_photo">
		<?php echo $this->Html->link($this->Html->image('screenshots/1.jpg', array('alt' => '')), array(), array('escape' => false, 'title' => '')); ?>
		<div class="info">
			<div class="title">
				Roccos Revenge
			</div>
			<div class="more_info clearfix">
				<div class="left">
					<p class="grey"><strong>Puntuación:</strong> * * * * *</p>
					<p class="grey"><strong>Actualizado el:</strong> 05-12-2112</p>
					<p class="grey"><strong>Duración:</strong> 18:32</p>
				</div>
				<div class="right">
					<p class="grey">
						<strong>Actores:</strong>
						<?php
						$actors = array('Rocco Siffredi', 'Mona Lee', 'Valentina Nappi', 'El osito de Mimosín');
						$links = array();
						foreach ($actors as $actor) {
							$links[] = $this->Html->link($actor, array());
						}
						echo implode(', ', $links);
						?>
					</p>
					<p class="grey">
						<strong>Categorías:</strong>
						<?php
						$actors = array('Actorporno', 'Sexo duro', 'Tetas grandes', 'Anal', 'En la cara');
						$links = array();
						foreach ($actors as $actor) {
							$links[] = $this->Html->link($actor, array());
						}
						echo implode(', ', $links);
						?>
					</p>
				</div>
			</div>
		</div>
	</div>
	<div class="small_photos">
		<?php echo $this->Html->link($this->Html->image('screenshots/2.jpg', array('alt' => '')), array(), array('escape' => false, 'title' => '')); ?>
		<?php echo $this->Html->link($this->Html->image('screenshots/3.jpg', array('alt' => '')), array(), array('escape' => false, 'title' => '')); ?>
		<?php echo $this->Html->link($this->Html->image('screenshots/4.jpg', array('alt' => '')), array(), array('escape' => false, 'title' => '')); ?>
	</div>
</div>
