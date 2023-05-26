<?php
session_start();
include_once("conexion.php");

// Control de acceso a traves de la URL
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
    <script src="functions.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" href="/DataTables/datatablesStyle.css" />
    <script src="/DataTables/datatables.js"></script>
    <link rel="stylesheet" href="css/bienvenida.css">
    <title>Mis Tickets | TICKR</title>
</head>
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
    <div id="header1">
        <h3>Bienvenid@ <?php echo $_SESSION['nom_usuario']; ?></h3>
    </div>
    <div id="tabla-tickets">
        <div id="tabla-header">
            <h1>Mis Tickets</h1>
        </div><hr>
        <?php
        $id_usuario = $_SESSION['id_usuario'];
        $tickets = mysqli_query($conexion, "SELECT * FROM ticket WHERE usuario_id = $id_usuario");
        if (mysqli_num_rows($tickets) == 0) {
            echo "No tiene ningún ticket.";
        } else {
            echo "<div id='tabla-datos'>
                    <table class='tablesorter' id='myTable'>
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Asunto</th>
                                <th>Fecha creación</th>
                                <th style='width:20%;'>Departamento</th>
                                <th style='width:12%;'>Estado</th>
                                <th>Última actividad</th>
                            </tr>
                        </thead>
                        <tbody>";
                        while($fila = mysqli_fetch_array($tickets)) {
                            extract($fila);
                            $fecha = date("d-m-Y H:i", strtotime($fecha));
                            $ultima_actividad = date("d-m-Y H:i", strtotime($ultima_actividad));
                            echo "<tr>
                                      <td style='width:10%;'>#$id_ticket</td>
                                      <td style='width:28%;'><a href='ver_ticket.php?id=$id_ticket'>$asunto</a></td>
                                      <td>$fecha</td>
                                      <td style='width:18%;'>$departamento</td>
                                      <td>$estado</td>
                                      <td>$ultima_actividad</td>
                                 </tr>";
                        }
              echo "</tbody></table>
                </div><br><hr>";
        }
        ?>
    </div>
    <script>

        // Permite ordenar columnas, filtrar y paginar tablas con el plugin DataTables
        $(document).ready( function () {
            $('#myTable').DataTable();
        });

    </script>
    <div id="btn-container">
        <div id="btn-img">
            <img src="img/post.png" alt="">
        </div>
        <div id="btn-content">
            <h4>¿Necesitas ayuda?</h4>
            <p>Crea un ticket explicándonos cualquier incidencia o duda que tengas. 
                Nuestros expertos buscarán una solución a tu medida y te responderán
                a la mayor brevedad posible.</p>
        </div>
        <div id="btn-button">
            <button class="btn btn-primary">
                <a href="crear_ticket.php" style="text-decoration: none; color: white;">Crear ticket</a>
            </button>
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