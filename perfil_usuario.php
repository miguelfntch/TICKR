<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="shortcut icon" href="img/grupo4Logo.png" type="image/x-icon">
   <link rel="stylesheet" href="css/mod_usuario.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="functions.js"></script>
   
   <title>Perfil | TICKR</title>
</head>

<?php
session_start();
include 'conexion.php';
if (!isset($_SESSION['id_usuario'])) {
   header("Location: login.html");
} else if (!isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario']==1){
   header("Location: login.html");
} else if ($_SESSION['tipo_usuario']==1) {
   header("Location: login.html");
}
$id_usuario = $_SESSION['id_usuario'];
$datos_usuario = mysqli_fetch_array(mysqli_query($conexion, "SELECT * FROM usuarios WHERE id_usuario = $id_usuario"));
extract($datos_usuario);
echo "<form action='perfil_modificado.php' method='POST' enctype='multipart/form-data'/>
   <img src='$imagen_url' alt='Imagen de perfil del usuario' id='imagen_perfil'><br>
   Imagen: <br>
   <div class='input_container'>
      <input name='archivo' type='file'/>
   </div>
   ID: <br> <input type='text' name='id' value='$id_usuario' readonly><br>
   Nombre: <br> <input type='text' name='nombre' value='$nombre'><br>
   Correo:<br> <input type='text' name='correo' value='$correo'><br>
   Usuario:<br> <input type='text' name='usuario' value='$usuario'><br>
   Contraseña: <br><input type='text' name='contraseña' value='$contraseña'><br>
   <input class='btn btn-success' type='submit' name='modificar' value='Modificar'>
   <a class='btn btn-primary' type='button' href='panel_usuario.php'>Atrás</a>
</form>";
?>
   <body>
      <nav>
         <h1 id="title">TICKR</h1>
         <a href="index.html">Inicio</a>           
         <a href="crear_ticket.php">Crear un ticket</a>
         <img src='<?php echo $_SESSION['imagen_url']; ?>' alt="Imagen de perfil del usuario" id="avatar" width="43px" height="42.8px">
         <button class="nav-item dropdown" id="btn-user">
            <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <?php echo $_SESSION['nom_usuario']; ?>
            </a>
            <div class="dropdown-menu">
               <a href="perfil_usuario.php" class="dropdown-item">Ver perfil</a>
               <a href="cierre_sesion.php" class="dropdown-item">Cerrar sesión</a>
            </div>
         </button>
      </nav>
   </body>
   <footer>
        <div class="contenedor-footer">
            <div class="content-foo">
                <h4>Phone</h4>
                <p>66445566</p>
            </div>
            <div class="content-foo">
                <h4>Email</h4>
                <p>tickr.sa@gmail.com</p>
            </div>
            <div class="content-foo">
                <h4>Location</h4>
                <p>España, Barcelona</p>
            </div>
        </div>
        <h2 class="titulo-final">&copy; 2023 TICKR S.A | LinkiaFP</h2>
    </footer>
</html>