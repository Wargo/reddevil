<?php

echo $this->Html->link(__('Crear nueva categoría', true), array('controller' => 'categories', 'action' => 'edit'));

echo '<table cellspacing="0" cellpadding="0">';

foreach ($categories as $category) {

	extract($category);

	echo '<tr>';
		echo '<td>' . $Category['name'] . '</td>';
		echo '<td>' . $this->Html->link(__('Editar', true), array('controller' => 'categories', 'action' => 'edit', $Category['id'])) . '</td>';
		echo '<td>' . $this->Html->link(__('Borrar', true), array('controller' => 'categories', 'action' => 'delete', $Category['id']), array(), __('¿Seguro?', true)) . '</td>';
	echo '</tr>';

}

echo '</table>';
