<?php

echo '<table cellspacing="0" cellpadding="0">';

foreach ($archivos as $archivo) {

	$excluir = array('.', '..', 'empty');
	if (in_array($archivo, $excluir)) {
		continue;
	}

	echo '<tr>';
		echo '<td>' . $archivo . '</td>';
		echo '<td>' . $this->Funciones->showFileSize(filesize(APP . 'raw' . DS . $archivo)) . '</td>';
		echo '<td>' . 
			$this->Html->link(__('Añadir como trailer', true), 
				array('controller' => 'videos', 'action' => 'add_file', 'file' => $archivo, 'mode' => 'trailer')
			) . '</td>';
		echo '<td>' . 
			$this->Html->link(__('Añadir como video', true), 
				array('controller' => 'videos', 'action' => 'add_file', 'file' => $archivo, 'mode' => 'video')
			) . '</td>';
	echo '</tr>';

}

echo '</table>';
