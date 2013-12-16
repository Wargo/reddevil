<?php
$sites = array(
	array(
		'cat' => 'los-chicos-del-cable',
		'name' => 'Los chicos del cable',
		'image' => 'h_uppf.jpg',
		'text' => '',
	),
	array(
		'cat' => 'glassman',
		'name' => 'The Glassman project',
		'image' => 'h_uppf.jpg',
		'text' => '',
	),
	array(
		'cat' => 'pornstar-school',
		'name' => 'Pornstar school',
		'image' => 'h_uppf.jpg',
		'text' => 'Pornstars School es una escuela de actrices porno profesionales, donde se da la oportunidad Y SE ENSEÑA a chicas nuevas que quieren empezar en el porno junto a actrices con experiencia, que las van guiando en cómo hacerse una verdadera PORNSTAR.

Es una nueva cara de los castings convencionales, aquí mezclamos la naturalidad, inocencia e inexperiencia de una modelo nueva, con la experiencia de una actriz veterana en el porno Y CONSEGUIMOS QUE UNA ACTRIZ AMATEUR SE CONVIERTA EN UNA PROFESIONAL. EL RESULTADO ES MORBO POR TODOS LOS COSTADOS!!!',
	),
	array(
		'cat' => 'un-pais-para-follarselo',
		'name' => 'Un país para follárselo',
		'image' => 'h_uppf.jpg',
		'text' => '',
	),
	array(
		'cat' => 'castings',
		'name' => 'Castings',
		'image' => 'h_uppf.jpg',
		'text' => '',
	),
);

echo '<div class="clearfix sites">';
foreach ($sites as $site) {

	echo '<a class="clearfix" href="' . $this->Html->url(array('controller' => 'videos', 'action' => 'home', 'page' => 1, 'category' => $site['cat'])) . '">';
		echo $this->Html->image($site['image'], array('class' => 'image'));
		echo '<h2 class="title">';
			echo $site['name'];
		echo '</h2>';
		echo '<p class="text">' . nl2br($site['text']) . '</p>';
	echo '</a>';

}
echo '</div>';
