<?php

echo $this->Html->link(__('Crear nueva foto', true), array('controller' => 'photos', 'action' => 'edit'));

echo '<table cellspacing="0" cellpadding="0">';

foreach ($photos as $photo) {

	extract($photo);

	extract(ClassRegistry::init('Video')->findById($Photo['video_id']));

	echo '<tr>';
		echo '<td>' . $this->Html->image('Photo/' . $Photo['id'] . ',fitCrop,60,60.jpg', array('width' => 60)) . '</td>';
		echo '<td>' . $Photo['title'] . '</td>';
		echo '<td>' . $Video['title'] . '</td>';
		echo '<td>' . ($Photo['main'] ? __('Principal') : '') . '</td>';
		echo '<td>' . ($Photo['adv'] ? __('Publi') : '') . '</td>';
		echo '<td>' . ($Photo['featured'] ? __('Destacada') : '') . '</td>';
		echo '<td>' . $this->Html->link(__('Editar', true), array('controller' => 'photos', 'action' => 'edit', $Photo['id'])) . '</td>';
		echo '<td>' . $this->Html->link(__('Borrar', true), array('controller' => 'photos', 'action' => 'delete', $Photo['id']), array(), __('¿Seguro?', true)) . '</td>';
	echo '</tr>';

}

echo '</table>';
