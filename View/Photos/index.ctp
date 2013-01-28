<?php

foreach ($videos as $video) {
	
	extract($video);

	echo $this->element('Photos/block', compact('Video'));

}

if ($pageCount > 1) {
	?>
	<div class="paging clearfix">
		<?php
		$key = $value = null;
		foreach ($this->params['named'] as $key => $value) {
		}
		if ($page > 1) {
			echo $this->Html->link(__('Anterior', true), array('controller' => 'photos', 'action' => 'index', $page - 1, $key => $value));
		} else {
			echo $this->Html->link(__('Anterior', true), array(), array('class' => 'selected'));
		}
		for ($i = 1; $i <= $pageCount; $i ++) {
			echo $this->Html->link($i, array('controller' => 'photos', 'action' => 'index', $i, $key => $value), array('class' => ($i == $page ? 'selected' : '')));
		}
		if ($page < $pageCount) {
			echo $this->Html->link(__('Siguiente', true), array('controller' => 'photos', 'action' => 'index', $page + 1, $key => $value));
		} else {
			echo $this->Html->link(__('Siguiente', true), array(), array('class' => 'selected'));
		}
		?>
	</div>
	<?php
}
