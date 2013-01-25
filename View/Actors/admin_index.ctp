<?php

echo $this->Html->link(__('Crear nuevo actor/actriz', true), array('controller' => 'actors', 'action' => 'edit'));

echo '<table cellspacing="0" cellpadding="0">';

foreach ($actors as $actor) {

	extract($actor);

	echo '<tr>';
		echo '<td>' . $this->Html->image('Actor/' . $Actor['id'] . ',fitCrop,60,60.jpg', array('width' => 60)) . '</td>';
		echo '<td>' . $Actor['name'] . '</td>';
		echo '<td>' . $this->Html->link(__('Editar', true), array('controller' => 'actors', 'action' => 'edit', $Actor['id'])) . '</td>';
		echo '<td>' . $this->Html->link(__('Borrar', true), array('controller' => 'actors', 'action' => 'delete', $Actor['id']), array(), __('¿Seguro?', true)) . '</td>';
	echo '</tr>';

}

echo '</table>';
