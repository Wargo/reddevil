<?php
foreach ($videos as $video) {
	
	extract($video);

	echo $this->element('Videos/block', compact('Video'));

}
?>
<div class="paging clearfix">
	<?php
	foreach ($this->params['named'] as $key => $value) {
	}
	if ($this->Paginator->params['paging']['Video']['prevPage']) {
		echo $this->Html->link(__('Anterior', true), array('controller' => 'videos', 'action' => 'home', $page - 1, $key => $value));
	} else {
		echo $this->Html->link(__('Anterior', true), array(), array('class' => 'selected'));
	}
	for ($i = 1; $i <= $this->Paginator->params['paging']['Video']['pageCount']; $i ++) {
		echo $this->Html->link($i, array('controller' => 'videos', 'action' => 'home', $i, $key => $value), array('class' => ($i == $page ? 'selected' : '')));
	}
	if ($this->Paginator->params['paging']['Video']['nextPage']) {
		echo $this->Html->link(__('Siguiente', true), array('controller' => 'videos', 'action' => 'home', $page + 1, $key => $value));
	} else {
		echo $this->Html->link(__('Siguiente', true), array(), array('class' => 'selected'));
	}
	?>
</div>
<?php
$more_videos = ClassRegistry::init('Video')->findMore($page, $conditions);
if (count($more_videos)) {
	?>
	<div class="more_videos">
		<p class="more_videos_button"><?php echo __('Siguientes vídeos', true); ?></p>
		<div class="photos clearfix">
			<?php
			foreach ($more_videos as $video) {
				extract($video);
				$more_photos = array(
					$this->Html->url('/img/screenshots/1,fitCrop,312,280.jpg'),
					$this->Html->url('/img/screenshots/2,fitCrop,312,280.jpg'),
					$this->Html->url('/img/screenshots/3,fitCrop,312,280.jpg'),
					$this->Html->url('/img/screenshots/4,fitCrop,312,280.jpg')
				);
				?>
				<div class="photo">
					<?php echo $this->Html->link($this->Html->image('screenshots/4,fitCrop,312,280.jpg', array('var' => "['" . implode("','", $more_photos) . "']", 'alt' => '', 'class' => '_rotate_photos')), array('controller' => 'videos', 'action' => 'view', $Video['id']), array('escape' => false)); ?>
					<div class="info">
						<p><strong><?php echo $this->Html->link($Video['title'], array('controller' => 'videos', 'action' => 'view', $Video['id'])); ?></strong></p>
						<p>Haz click para acceder al vídeo completo</p>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
