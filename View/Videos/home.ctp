<?php
foreach ($videos as $video) {
	
	extract($video);

	echo $this->element('Videos/block', compact('Video'));

}
?>
<div class="paging clearfix">
	<?php
	$page = $this->Paginator->params['paging']['Video']['page'];
	if ($page != 1) {
		echo $this->Html->link(__('Anterior', true), array('controller' => 'videos', 'action' => 'home', $page - 1));
	} else {
		echo $this->Html->link(__('Anterior', true), array(), array('class' => 'selected'));
	}
	for ($i = 1; $i <= $this->Paginator->params['paging']['Video']['count']; $i ++) {
		echo $this->Html->link($i, array('controller' => 'videos', 'action' => 'home', $i), array('class' => ($i == $page ? 'selected' : '')));
	}
	if ($page != $this->Paginator->params['paging']['Video']['count']) {
		echo $this->Html->link(__('Siguiente', true), array('controller' => 'videos', 'action' => 'home', $page + 1));
	} else {
		echo $this->Html->link(__('Siguiente', true), array(), array('class' => 'selected'));
	}
	?>
</div>
<div class="more_videos">
	<p class="more_videos_button"><?php echo __('Siguientes vídeos', true); ?></p>
	<div class="photos clearfix">
		<?php
		$more_videos = ClassRegistry::init('Video')->findMore($page);
		foreach ($more_videos as $video) {
			extract($video);
			?>
			<div class="photo">
				<?php echo $this->Html->image('screenshots/4,fitCrop,312,280.jpg', array('alt' => '')); ?>
				<div class="info">
					<p><strong><?php echo $Video['title']; ?></strong></p>
					<p>Haz click  para acceder al vídeo completo</p>
				</div>
			</div>
			<?php
		}
		?>
	</div>
</div>
