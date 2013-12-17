<?php
$sites = array(
	array(
		'url' => 'loschicosdelcable',
		'cat' => 'los-chicos-del-cable',
		'name' => 'Los chicos del cable',
		'image' => 'sites/chicos-del-cable.jpg',
		'text' => 'Serie amateur de REDDEVILX de parejas, donde podréis ver el morbo de gente amateur en sus propias casas. Damos la oportunidad a parejas amateurs y anónimas, que quieren grabarse un vídeo porno en su propia casa. Los chicos del cable lo organizan todo!

Las parejas nos llaman, vamos a su casa, les montamos toda la instalación, cámaras, focos, micrófonos... y nos vamos. Las parejas graban su escena de sexo en la intimidad, pero con nuestras cámaras y cuando terminan, nos llaman, recojemos todo, les pagamos y nos vamos.',
	),
	array(
		'url' => 'glassman',
		'cat' => 'glassman',
		'name' => 'The Glassman project',
		'image' => 'sites/glassman.jpg',
		'text' => 'Gassman es un seductor, que tiene muy claro que SÍ es posible ligarse a una chica y llevársela a la cama fácilmente. Glassman va equipado de unas gafas cámara, que pasan totalmente desapercibidas, y la chica no sabe que se la esta grabando, Glassman puede estar en cualquier sitio, Glassman puede grabarte en un cine, en una cafetería, en una tienda...

Todas caen rendidas a los brazos de nuestro seductor GLASSMAN, quieres saber como acaban sus ligues? EXCELENTE ESCENAS DE P.O.V',
	),
	array(
		'url' => 'pornstarschool',
		'cat' => 'pornstar-school',
		'name' => 'Pornstar school',
		'image' => 'sites/pornstar.jpg',
		'text' => 'Pornstars School es una escuela de actrices porno profesionales, donde se da la oportunidad Y SE ENSEÑA a chicas nuevas que quieren empezar en el porno junto a actrices con experiencia, que las van guiando en cómo hacerse una verdadera PORNSTAR.

Es una nueva cara de los castings convencionales, aquí mezclamos la naturalidad, inocencia e inexperiencia de una modelo nueva, con la experiencia de una actriz veterana en el porno Y CONSEGUIMOS QUE UNA ACTRIZ AMATEUR SE CONVIERTA EN UNA PROFESIONAL. EL RESULTADO ES MORBO POR TODOS LOS COSTADOS!!!',
	),
	array(
		'url' => 'unpaisparafollarselo',
		'cat' => 'un-pais-para-follarselo',
		'name' => 'Un país para follárselo',
		'image' => 'sites/pais.jpg',
		'text' => 'En un país para follárselo queremos llevar al porno las fiestas populares y tradiciones que hay en cientos de pueblos en España. Queremos acercar el porno a los ciudadanos y hacerles participes de nuestras escenas en sus calles y visitaremos todos los rincones de España para hacer que las fiestas de cada pueblo y cuidad sean un poco mas picantes.

También visitaremos pueblos para ver su gastronomía y sus chicas para saber lo que alli comen...',
	),
	/*array(
		'url' => 'castings',
		'cat' => 'castings',
		'name' => 'Castings',
		'image' => 'h_uppf.jpg',
		'text' => 'Serie de castings con chicas nuevas, donde las ponemos a prueba para que nos enseñen lo que ellas saben hacer en el sexo.',
	),*/
);

echo '<div class="clearfix sites">';
foreach ($sites as $site) {

	echo '<a class="clearfix" href="http://www.' . $site['url'] . '.reddevilx.com">';
		echo $this->Html->image($site['image'], array('class' => 'image'));
		echo '<h2 class="title">';
			echo $site['name'];
		echo '</h2>';
		echo '<p class="text">' . nl2br($site['text']) . '</p>';
	echo '</a>';

}
echo '</div>';
