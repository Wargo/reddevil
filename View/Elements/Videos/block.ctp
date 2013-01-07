<div class="block_video">
	<div class="clearfix">
		<div class="main_photo">
			<?php echo $this->Html->link($this->Html->image('play.png', array('alt' => '')), array(), array('escape' => false, 'class' => 'play', 'title' => 'Ver vídeo')); ?>
			<?php echo $this->Html->image('screenshots/1.jpg', array('class' => 'image', 'alt' => '')); ?>
			<div class="info">
				<div class="title">
					<?php echo $this->Html->link('Roccos Revenge', array()); ?>
				</div>
				<div class="more_info clearfix">
					<div class="left">
						<p class="grey"><strong><?php echo __('Puntuación'); ?>:</strong> * * * * *</p>
						<p class="grey"><strong><?php echo __('Actualizado el'); ?>:</strong> 05-12-2112</p>
						<p class="grey"><strong><?php echo __('Duración'); ?>:</strong> 18:32</p>
					</div>
					<div class="right">
						<p class="grey">
							<strong><?php echo __('Actores'); ?>:</strong>
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
							<strong><?php echo __('Categorías'); ?>:</strong>
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
			<?php
			$images = array('screenshots/2.jpg', 'screenshots/3.jpg', 'screenshots/4.jpg');
			shuffle($images);
			foreach ($images as $image) {
				echo $this->Html->link($this->Html->image($image, array('alt' => '')), array(), array('escape' => false, 'title' => 'Ver vídeo'));
			}
			?>
		</div>
	</div>
	<div class="footer clearfix">
		<?php echo $this->Html->link(__('Haz click aquí para suscribirte', true), array(), array('class' => 'suscribe')); ?>
		<?php echo $this->Html->link(__('Privado', true), array(), array('class' => 'private')); ?>
		<?php echo $this->Html->link(__('Ver fotos (32)', true), array(), array('class' => 'num_photos')); ?>
	</div>
</div>
