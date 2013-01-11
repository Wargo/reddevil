<?php

echo $this->Html->link(__('Crear nuevo vídeo', true), array('controller' => 'videos', 'action' => 'edit'));

echo '<table cellspacing="0" cellpadding="0">';

foreach ($videos as $video) {

	extract($video);

	echo '<tr>';
		echo '<td>' . $Video['title'] . '</td>';
		echo '<td>' . $this->Html->link(__('Editar', true), array('controller' => 'videos', 'action' => 'edit', $Video['id'])) . '</td>';
		echo '<td>' . $this->Html->link(__('Borrar', true), array('controller' => 'videos', 'action' => 'delete', $Video['id']), array(), __('¿Seguro?', true)) . '</td>';
	echo '</tr>';

}

echo '</table>';
