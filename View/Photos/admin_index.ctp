<?php

echo $this->Html->link(__('Crear nueva foto'), array('admin' => true, 'controller' => 'photos', 'action' => 'edit'));
echo ' ';
echo $this->Html->link(__('Crear múltiples fotos'), array('admin' => true, 'controller' => 'photos', 'action' => 'multiple'), array('class' => '_dialog'));

echo '<table cellspacing="0" cellpadding="0">';

foreach ($photos as $photo) {

	extract($photo);

	$video = ClassRegistry::init('Video')->findById($Photo['video_id']);
	if ($video) {
		extract($video);
	}

	echo '<tr>';
		echo '<td>' . $this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,60,60.jpg', array('width' => 60)) . '</td>';
		echo '<td>' . $Photo['title'] . '</td>';
		echo '<td>' . (!empty($Video) ? $Video['title'] : '') . '</td>';
		echo '<td>' . ($Photo['main'] ? __('Principal Trailer') : '') . '</td>';
		echo '<td>' . ($Photo['main_video'] ? __('Principal Vídeo') : '') . '</td>';
		echo '<td>' . ($Photo['adv'] ? __('Publi') : '') . '</td>';
		echo '<td>' . ($Photo['featured'] ? __('Destacada') : '') . '</td>';
		echo '<td>' . $this->Html->link(__('Editar', true), array('controller' => 'photos', 'action' => 'edit', $Photo['id'])) . '</td>';
		echo '<td>' . $this->Html->link(__('Borrar', true), array('controller' => 'photos', 'action' => 'delete', $Photo['id']), array(), __('¿Seguro?', true)) . '</td>';
	echo '</tr>';

}

echo '</table>';

echo '<div class="hidden" id="dialog-message" title="' . __('Creando múltiple fotos') . '"></div>';
