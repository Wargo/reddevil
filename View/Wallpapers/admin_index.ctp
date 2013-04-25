<?php

echo $this->Html->link(__('Crear nuevo fondo', true), array('controller' => 'wallpapers', 'action' => 'edit'));

echo '<table cellspacing="0" cellpadding="0">';

foreach ($wallpapers as $wallpaper) {

	extract($wallpaper);

	echo '<tr>';
		echo '<td>' . $this->Html->image('Wallpaper/' . $Wallpaper['id'] . ',fitCrop,60,60.jpg', array('width' => 60)) . '</td>';
		echo '<td>' . $Wallpaper['name'] . '</td>';
		echo '<td>' . (($Wallpaper['active'])?__('Activo'):__('Inactivo')) . '</td>';
		echo '<td>' . $this->Html->link(__('Editar', true), array('controller' => 'wallpapers', 'action' => 'edit', $Wallpaper['id'])) . '</td>';
		echo '<td>';
		if (!$Wallpaper['active']) {
			echo $this->Html->link(__('Activar', true), array('controller' => 'wallpapers', 'action' => 'active', $Wallpaper['id']), array(), __('¿Activar este fondo?', true));
		}
		echo '</td>';
		echo '<td>' . $this->Html->link(__('Borrar', true), array('controller' => 'wallpapers', 'action' => 'delete', $Wallpaper['id']), array(), __('¿Seguro?', true)) . '</td>';
	echo '</tr>';

}

echo '</table>';
