<?php
session_start();
include_once("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
} else if (!isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario']==1){
    header("Location: login.html");
} else if ($_SESSION['tipo_usuario']==1) {
    header("Location: login.html");
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="shortcut icon" href="img/grupo4Logo.png" type="image/x-icon">	
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
        <script src="functions.js"></script>
        <link rel="stylesheet" href="css/bienvenida.css">
        <title>Crear Ticket | TICKR</title>
    </head>
    <body>
    <nav>
        <h1 id="title">TICKR</h1>
        <a href="index.html">Inicio</a>           
        <a href="panel_usuario.php">Mis tickets</a>
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
    <div id="form-ticket">
        <div id="form-header">
            <h1>Enviar un ticket</h1>
        </div>
        <div id="form-fields">
            <form action="ticket_creado.php" method="post">
                    <label for="departamento">Departamento</label><br>
                    <input type="text" name="departamento" autocomplete="off"><br>
                    <label for="asunto">Asunto</label><br>
                    <input type="text" name="asunto" autocomplete="off"><br>
                    <label for="descripcion" style="margin-bottom: 7px;">Descripción</label><br>
                    <textarea name="descripcion" id="form-ta" rows="10"></textarea><br>
                    <input type="submit" value="Enviar" id="form-btn" class="btn btn-success">
                    <button id="btn-atras-ticket" type="button" class="btn btn-primary">
                        <a href="panel_usuario.php" style="text-decoration: none;color:#fff;">Atrás</a>
                    </button>
            </form>
            <script>
                ClassicEditor
                    .create(document.querySelector('#form-ta'))
                    .catch( error => {
                console.error( error );
                });
            </script>
        </div>
    </div>
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
    </body>
</html>