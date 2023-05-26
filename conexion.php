<?php
$server = "localhost";
$user = "root";
$pass = "root";
$db = "proyecto";

$conexion = mysqli_connect($server, $user, $pass, $db) or die ("Error al conectar con la base de datos");

///////COMPROBAR QUE SE HA CONECTADO A LA BASE DE DATOS CON UN IF ELSE/////
/* 
if($conexion){
	echo 'Conexión Exitosa con la base de datos.';
}else{
	echo 'ERROR No se ha podido conectar con la base de datos.';
}
*/

?>