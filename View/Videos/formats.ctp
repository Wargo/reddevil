<?php

$download = array();

//if (!empty($Video['formats'])) {

	//$formats = Configure::read('formats');
	$formats = unserialize($Video['formats']);
	// TODO ...
	$formats = array(
		'mp4' => array(
			's' => 149,
			'm' => 424,
			'l' => 843,
		),
	);

	if (empty($formats[$type])) {

		echo 'Próximamente...';

	} else {

		foreach ($formats[$type] as $key => $value) {

			if ($Video['id'] == '50ed6523-1b14-40fa-9903-3414b4188753') { // el pisito
				if ($key == 's' || $key == 'm') {
					continue;
				}
			}
			if ($Video['id'] == '5108e954-10fc-44a8-a65a-4b96bca5d2a0') { // doctor y cumple anos
				if ($key == 's') {
					continue;
				}
			}
			if ($Video['id'] == '51095021-2bd8-48c5-9ac7-6559bca5d2a0') { // Mi primera vez en el porno
				if ($key == 's' || $key == 'm') {
					continue;
				}
			}
			if ($Video['id'] == '510f7f58-29bc-4239-a04d-7f23bca5d2a0') { // Fantasía hard
				if ($key == 's' || $key == 'm') {
					continue;
				}
			}

			switch ($key) {
				
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

			$download[] = $this->Html->link($t/* . ' ' . $value. 'Mb'*/, '/links/' . $cookies['user'] . '/' . $cookies[$Video['id']] . '_' . $type . '_' . $key, array());

		}

		echo __('Tamaños') . ': ' . implode(', ', $download);
	}

//}
