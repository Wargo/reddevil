<?php
if (!empty($this->params['actor'])) {
	$slug = $this->params['actor'];
	$id = ClassRegistry::init('Actor')->field('id', compact('slug'));
	extract(ClassRegistry::init('Actor')->findById($id));
	echo $this->element('Actor/profile', compact('Actor'));
} else {
	echo $this->element('Videos/promo');
}
foreach ($videos as $video) {
	
	extract($video);

	echo $this->element('Videos/block', compact('Video'));

}

if ($pageCount > 1) {
	?>
	<div class="paging clearfix">
		<?php
		$url = array('controller' => 'videos', 'action' => $this->params['action']);
		if (!empty($this->request->data['Video']['search'])) {
			$url['search'] = $this->request->data['Video']['search'];
		}
		$key = $value = null;
		if (!empty($this->params['actor'])) {
			$url['actor'] = $this->params['actor'];
		}
		if ($page > 1) {
			$url['page'] = $page - 1;
			echo $this->Html->link(__('Anterior', true), $url);
		} else {
			echo $this->Html->link(__('Anterior', true), array(), array('class' => 'selected'));
		}
		for ($i = 1; $i <= $pageCount; $i ++) {
			$url['page'] = $i;
			echo $this->Html->link($i, $url, array('class' => ($i == $page ? 'selected' : '')));
		}
		if ($page < $pageCount) {
			$url['page'] = $page + 1;
			echo $this->Html->link(__('Siguiente', true), $url);
		} else {
			echo $this->Html->link(__('Siguiente', true), array(), array('class' => 'selected'));
		}
		?>
	</div>
	<?php
}

$more_videos = ClassRegistry::init('Video')->findMore($page, $conditions);
if (count($more_videos)) {
	?>
	<div class="more_videos">
		<p class="more_videos_button"><?php echo __('Siguientes vídeos', true); ?></p>
		<div class="photos clearfix">
			<?php
			foreach ($more_videos as $video) {
				extract($video);
				$more_photos = ClassRegistry::init('Photo')->find('all', array(
					'conditions' => array(
						'video_id' => $Video['id'],
						'Photo.active' => 1
					),
					'limit' => 6,
					'order' => array('rand()')
				));
				$var = array();
				foreach ($more_photos as $photo) {
					extract($photo);
					$folder = explode('-', $Photo['id']);
					$folder = substr($folder[1], 0, 3);
					$var[] = $this->Html->url('/img/Photo/' . $folder . '/' . $Photo['id'] . ',fitCrop,312,280.jpg');
				}
				$alt = ClassRegistry::init('Photo')->getTitle($Photo);
				?>
				<div class="photo">
					<?php echo $this->Html->link($this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,312,280.jpg', array('var' => "['" . implode("','", $var) . "']", 'alt' => $alt, 'title' => $alt, 'class' => '_rotate_photos')), array('controller' => 'videos', 'action' => 'view', $Video['slug']), array('escape' => false)); ?>
					<div class="info">
						<p><strong><?php echo $this->Html->link($Video['title'], array('controller' => 'videos', 'action' => 'view', $Video['slug'])); ?></strong></p>
						<p><?php echo __('Haz click para acceder al vídeo completo'); ?></p>
					</div>
				</div>
				<?php
			}
			?>
		</div>
	</div>
	<?php
}
