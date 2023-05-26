<?php
session_start();
header("location:login.html");
// Destruye la sesion actual
session_destroy();
?>

