<?php

$download = array();

$formats = Configure::read('formats');
$formats['mp4']['sizes'][] = 'l';

$ext = $type;

if ($type == '3gp') {

	$type = 'v3gp';

}

foreach ($formats[$type]['sizes'] as $size) {

	switch ($size) {
		
		case 's':
			$t = __('pequeño');
			break;
		case 'm':
			$t = __('mediano');
			break;
		case 'l':
			$t = __('grande');
			break;

	}

	$link = Security::hash($cookies['user'] . '_' . $Video['id'], null, true);

	$file = '/links/' . $cookies['user'] . '/' . $link . '_' . $ext . '_' . $size . '.' . $ext;

	if (file_exists(WWW_ROOT . $file)) {

		$download[] = $this->Html->link($t . ' ' . number_format(filesize(WWW_ROOT . $file) / 1024 / 1024, 2, ',', '.') . ' Mb', $file, array());

	}


}

if ($download) {

	echo __('Tamaños') . ': ' . implode(', ', $download);
	echo '<br><small>' . __('Pincha botón derecho sobre el tamaño que quieras y luego "descargar" o "guardar" para descargarte el vídeo') . '</small>';

} else {

	echo __('Próximamente...');

}
