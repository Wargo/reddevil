<?php

$download = array();

if (!empty($Video['formats'])) {

	$formats = unserialize($Video['formats']);
	// TODO ...
	$formats = array(
		'3gp' => array(
			's' => 149,
		),
		'mp4' => array(
			's' => 149,
			'm' => 424,
			'l' => 843,
		),
		'flv' => array(
			's' => 149,
			'm' => 424,
			'l' => 843,
		),
		'wmv' => array(
			's' => 149,
			'm' => 424,
			'l' => 843,
		),
	);

	foreach ($formats[$type] as $key => $value) {

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

		$download[] = $this->Html->link($t . ' ' . $value. 'Mb', array(), array());

	}

	echo implode(', ', $download);

}
