<?php
$this->csvfilename = 'usuarios';
echo __('Email') . ';';
echo __('Nombre') . ';';
echo __('Creado') . ';';
echo "\r\n";
foreach ($users as $user) {
	extract($user);
	echo $User['email'] . ';';
	echo $User['name'] . ';';
	echo $this->Fechas->mostrar_fecha('marca',$user['User']['created']) . ';';
	echo "\r\n";
}
