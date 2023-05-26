<?php
session_start();
require("conexion.php");
$correo = $_SESSION['correo'];
$usuario_actual = mysqli_fetch_array(mysqli_query($conexion, "SELECT id_usuario FROM usuarios WHERE correo='$correo'"));
$idBorrar = $_POST['borrar'];
foreach ($idBorrar as $id) {
    mysqli_query($conexion, "DELETE FROM usuarios WHERE id_usuario='$id'");
    if ($usuario_actual[0] == $id) {
        header("Location: login.html");
    } else {
	    header("Location: bienvenida.php");
    }
}

?>