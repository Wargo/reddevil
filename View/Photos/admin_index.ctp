<?php

echo $this->Html->link(__('Crear nueva foto', true), array('controller' => 'photos', 'action' => 'edit'));

echo '<table cellspacing="0" cellpadding="0">';

foreach ($photos as $photo) {

	extract($photo);

	echo '<tr>';
		echo '<td>' . $Photo['title'] . '</td>';
		echo '<td>' . $this->Html->link(__('Editar', true), array('controller' => 'photos', 'action' => 'edit', $Photo['id'])) . '</td>';
		echo '<td>' . $this->Html->link(__('Borrar', true), array('controller' => 'photos', 'action' => 'delete', $Photo['id']), array(), __('¿Seguro?', true)) . '</td>';
	echo '</tr>';

}

echo '</table>';
