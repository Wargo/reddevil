<?php
$registered = ($this->Session->read('Auth.User.id') && strtotime($this->Session->read('Auth.User.caducidad'))>time());
echo $this->element('Actor/profile', compact('Actor'));
?>
<div class="actor_photos" id="gallery">
	<?php
	foreach ($photos as $photo) {

		extract($photo);

		$aux = explode('-', $Photo['id']);
		$folder = substr($aux[1], 0, 3);
		$path = '/img/Photo/' . $folder . '/' . $Photo['id'] . ',fitInside,1024,768.jpg';

		$alt = ClassRegistry::init('Photo')->getTitle($Photo);

		echo $this->Html->link($this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,320,320.jpg', array('alt' => $alt, 'title' => $alt)),
			$path,
			array('escape' => false, 'title' => $alt)
		);

	}
	?>
</div>
<script type="text/javascript">
<?php if ($registered): ?>
$(function() {
	$('#gallery a').lightBox();
});
<?php else: ?>
	$('#gallery a').bind('click', function() { 
		load_popup();
		return false;
	});
<?php endif; ?>
</script>
<?php
$pageCount = $this->params['paging']['Photo']['pageCount'];
if ($pageCount > 1) {
	?>
	<div class="paging clearfix">
		<?php
		if ($page > 1) {
			echo $this->Html->link(__('Anterior', true), array('controller' => 'photos', 'action' => 'view', 'actor' => $Actor['slug'],  'page' => $page - 1));
		} else {
			echo $this->Html->link(__('Anterior', true), array(), array('class' => 'selected'));
		}
		for ($i = 1; $i <= $pageCount; $i ++) {
			echo $this->Html->link($i, array('controller' => 'photos', 'action' => 'view', 'actor' => $Actor['slug'], 'page' => $i), array('class' => ($i == $page ? 'selected' : '')));
		}
		if ($page < $pageCount) {
			echo $this->Html->link(__('Siguiente', true), array('controller' => 'photos', 'action' => 'view', 'actor' => $Actor['slug'], 'page' => $page + 1));
		} else {
			echo $this->Html->link(__('Siguiente', true), array(), array('class' => 'selected'));
		}
		?>
	</div>
	<?php
}
