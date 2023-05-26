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

$id_ticket = $_GET['id'];
$ticket = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT * FROM ticket WHERE id_ticket = $id_ticket"));
$asunto = $ticket['asunto'];
$fecha = $ticket['fecha'];
$fecha_format = date("d-m-Y H:i", strtotime($fecha));
$ultima_act = date("d-m-Y H:i", strtotime($ticket['ultima_actividad']));
$departamento = $ticket['departamento'];
$estado = $ticket['estado'];
$descripcion = $ticket['descripcion'];
$respuesta = $ticket['respuesta'];
$avatar = $_SESSION['imagen_url'];
$nombre_usuario = $_SESSION['nombre_completo'];

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
        <title><?php echo  $asunto ?> | TICKR</title>
    </head>
    <body>
        <nav>
            <h1 id="title">TICKR</h1>
            <a href="index.html">Inicio</a>           
            <a href="panel_usuario.php">Mis tickets</a>
            <a href="crear_ticket.php">Crear un ticket</a>
            <img src='<?php echo $avatar; ?>' alt="Imagen de perfil del usuario" id="avatar" width="43px" height="42.8px">
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
        <div id="ticket-container">
        <?php
            echo "<p id='t-estado'>$estado</p>
                <h1 id='t-asunto'>$asunto</h1>
                <p id='id-dept'>ID: #$id_ticket <br>Dpto: $departamento<br>Creado: $fecha_format</p><hr>
                <div id='t-desc-user'>
                    <img src=$avatar id='avatar' style='width:55px'>
                    <p>$nombre_usuario</p> 
                </div>
                <p id='t-desc'>$descripcion</p><hr>";
                if (!empty($respuesta)) {
                    $url = mysqli_fetch_array(mysqli_query($conexion, "SELECT imagen_url FROM usuarios WHERE id_usuario=1"))[0];
                    echo "<div id='t-desc-user'>
                            <img src='$url' id='avatar' style='width:55px;'>
                            <p>Admin</p> 
                        </div>
                    <p id='t-resp'>$respuesta</p><hr><p id='id-dept'>Última actividad: $ultima_act</p>";
                }
        ?>
            <button id="btn-atras-ticket" type="button" class="btn btn-primary" onclick="window.history.back()">Atrás</button>
        </div>
        <script>
            let estado = document.getElementById('t-estado');
            if (estado.innerHTML == 'Pendiente') {
                estado.style.backgroundColor = '#ffd633'
                estado.style.color = '#333333'
            } else if (estado.innerHTML == 'Finalizado') {
                estado.style.backgroundColor = '#009900'
                estado.style.color = '#fff'
            } else if (estado.innerHTML == 'En proceso') {
                estado.style.backgroundColor = '#f58d42'
                estado.style.color = '#fff'
            }
            
        </script>
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