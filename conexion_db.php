<?php
$db = new mysqli('localhost', 'root', '', 'db_kitchen_system');
$acentos = $db->query("SET NAMES 'utf8'");

//Servidor, Usuario, Contraseña, Nombre base de datos.

if($db->connect_error < 0){
	die('No se puede conectar a la base de datos!! [' . $db->connect_error . ']');
}
?>