<?php

foreach ($contacts as $contact) {

	extract($contact);

	if (empty($Contact['comment'])) {
		continue;
	}

	echo '<ul style="margin-bottom:20px;">';

		echo '<li>Tipo de contacto: ' . $Contact['type'] . '</li>';
		echo '<li>Nombre: ' . $Contact['name'] . '</li>';
		echo '<li>Edad: ' . $Contact['age'] . '</li>';
		echo '<li>País: ' . $Contact['country'] . '</li>';
		echo '<li>Ciudad: ' . $Contact['city'] . '</li>';
		echo '<li>Teléfono: ' . $Contact['phone'] . '</li>';
		echo '<li>Email: ' . $Contact['email'] . '</li>';
		echo '<li>Comentario: ' . $Contact['comment'] . '</li>';
		echo '<li>Fecha: ' . $Contact['created'] . '</li>';
		echo '<li>IP: ' . $Contact['ip'] . '</li>';

	echo '</ul>';

}
