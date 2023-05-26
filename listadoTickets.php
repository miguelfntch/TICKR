<?php
session_start();
include ('conexion.php');
if (!isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario']==0){
    header("Location: login.html");
} else if ($_SESSION['tipo_usuario']==0) {
    header("Location: login.html");
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        
        <script src="functions.js"></script>
        <link rel="stylesheet" href="css/bienvenida.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>

        <link rel="stylesheet" href="/DataTables/datatablesStyle.css" />
        <script src="/DataTables/datatables.js"></script>
        <link rel="shortcut icon" href="img/grupo4Logo.png" type="image/x-icon">
        <title>Tickets | TICKR</title>
    </head>
    <body>
        <nav>
            <h1 id="title">TICKR</h1>
            <a href="index.html">Inicio</a>           
            <a href="admin_view.php">Administración</a>
            <a href="bienvenida.php">Usuarios</a>
            <img src='<?php echo $_SESSION['imagen_url']; ?>' alt="Imagen de perfil del usuario" id="avatar" width="43px" height="42.8px">
            <button class="nav-item dropdown" id="btn-user">
                <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $_SESSION['nom_usuario']; ?>
                </a>
                <div class="dropdown-menu">
                    <a href="cierre_sesion.php" class="dropdown-item">Cerrar sesión</a>
                </div>
            </button>
        </nav>
    <div class="container mt-5" id="cont-mt5">
        <h2 class="titulo2">Tickets de usuarios</h2><hr>
        <table class="table mt-5"  class='tablesorter' id='myTable' style="background-color: rgba(255, 255, 255, 0.671);
    backdrop-filter: blur(3px);">
        <thead>
            <tr>
            <th>Id</th>
            <th>Asunto</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Departamento</th>
            <th>Estado</th>
            <th style='text-align:center'>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            // Conexión a la base de datos
            $conexion = mysqli_connect($server, $user, $pass, $db) or die("Error al conectar con la base de datos");

            // Procesamiento del formulario de eliminación
            if (isset($_POST["eliminar_ticket"])) {
            $id = $_POST["eliminar_ticket"];
            $sql = "DELETE FROM ticket WHERE id_ticket = $id";
            if (mysqli_query($conexion, $sql)) {
                echo "<div class='alert alert-success'>El ticket ha sido eliminado correctamente.</div>";
            } else {
                echo "<div class='alert alert-danger'>Error al eliminar el ticket: " . mysqli_error($conexion) . "</div>";
            }
            }

            // Consulta a la base de datos
            $sql = "SELECT * FROM ticket";
            $result = mysqli_query($conexion, $sql);
            // Generación de las filas de la tabla con los datos de la base de datos
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    // extract($fila);
                    $cont = 0;
                    echo "<tr>";
                    echo "<td style='width:6%;'>" . $row["id_ticket"] . "</td>";
                    echo "<td style='width:23%;'>" . $row["asunto"] . "</td>";
                    echo "<td style='width:20%;'>" . $row["correo"] . "</td>";
                    echo "<td style='width:15%;'>" . $row["fecha"] . "</td>";
                    echo "<td style='width:17%;'>" . $row["departamento"] . "</td>";
                    if ($row["estado"]=="Pendiente"){
                        echo "<td id='t-estado' style='width:10%; background-color:#ffd633;text-align:center'>" . $row["estado"] . "</td>";
                    } else if ($row["estado"]=="Finalizado") {
                        echo "<td id='t-estado' style='width:10%; background-color:#009900;text-align:center;color:#fff'>" . $row["estado"] . "</td>";
                    } else if ($row["estado"]=="En proceso"){
                        echo "<td id='t-estado' style='width:10%; background-color:#f58d42;text-align:center;color:#fff'>" . $row["estado"] . "</td>";
                    }
                    echo "<td style='text-align:center;width:10%;'>";
                    echo "<div class='btn-group' role='group'>";
                    echo "<a href='editTicket.php?id=" . $row["id_ticket"] . "'><button type='button' class='btn btn-primary btn-sm'><i class='bi bi-pencil-square'></i></button></a>";
                    echo "<form method='post' onsubmit='return confirm(\"¿Estás seguro de que deseas eliminar este ticket?\")' style='display:inline'>";
                    echo "<input type='hidden' name='eliminar_ticket' value='" . $row["id_ticket"] . "'>";
                    echo "<button type='submit' class='btn btn-danger btn-sm' style='margin-left:2px;'><i class='bi bi-trash'></i></button>";
                    echo "</form>";
                    echo "</div>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
            echo "<tr><td colspan='6'>No hay datos disponibles en la tabla</td></tr>";
            }

            // Cierre de la conexión
            mysqli_close($conexion);
            ?>
            <script>
                $(document).ready( function () {
                    $('#myTable').DataTable();
                });
            </script>
        </tbody>
        </table><hr>
        <div class='d-inline'>
            <a href='admin_view.php' class='btn btn-primary' style='width: 20%; margin-bottom: 5%;'>Atrás</a>
            </div>

    </div>
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