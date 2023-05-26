<?php
session_start();
include_once("conexion.php");

if (!isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario']==0){
    header("Location: login.html");
} else if ($_SESSION['tipo_usuario']==0) {
    header("Location: login.html");
}

if (isset($_GET['id']) || isset($_POST['id'])) {
    // Obtener el ID del ticket
    $id = isset($_GET['id']) ? $_GET['id'] : $_POST['id'];
    $query = "SELECT * FROM ticket WHERE id_ticket = $id";
    $result = mysqli_query($conexion, $query);
    $ticket = mysqli_fetch_assoc($result);
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8"> 
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="functions.js"></script>
    <link rel="stylesheet" href="css/login.css">
    <link rel="shortcut icon" href="img/grupo4Logo.png" type="image/x-icon">
    <title>Editar ticket | TICKR</title>
</head>

<body>
    <nav>
        <h1 id="title">TICKR</h1>
        <a href="index.html">Inicio</a>           
        <a href="admin_view.php">Administración</a>
        <a href="bienvenida.php">Usuarios</a>
        <a href="listadoTickets.php">Tickets</a>
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
    <div class="container" id="container-edit-ticket">
    <br>
        <form action="respuesta_creada.php" method="POST" class="row g-3">
            <input type="hidden" name="id" value="<?php echo $ticket['id_ticket']; ?>" readonly>
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="text" name="fecha" value="<?php echo date("d-m-Y H:i", strtotime($ticket['fecha'])); ?>" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="ultima_actividad" class="form-label">Ultima actividad:</label>
                <input type="text" name="ultima_actividad" value="<?php echo date("d-m-Y H:i", strtotime($ticket['ultima_actividad'])); ?>" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email:</label>
                <input type="email" name="email" value="<?php echo $ticket['correo']; ?>" class="form-control" readonly>
            </div>
            <div class="col-md-6">
                <label for="departamento" class="form-label">Departamento:</label>
                <input type="text" name="departamento" value="<?php echo $ticket['departamento']; ?>" class="form-control" readonly>
            </div>
            <div class="col-md-12">
                <label for="asunto" class="form-label">Asunto:</label>
                <input type="text" name="asunto" value="<?php echo $ticket['asunto']; ?>" class="form-control" readonly>
            </div>
            <div class="col-md-12">
                <label for="mensaje" class="form-label">Mensaje:</label>
                <textarea name="mensaje" class="form-control" rows="8" readonly><?php echo strip_tags($ticket['descripcion'], ); ?></textarea>
            </div>
            <div class="col-md-3">
            <br>
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" id="inputState" class="form-control">
                    <option value="En proceso" <?php if ($ticket['estado'] == "En proceso") echo "selected"; ?>>En proceso</option>
                    <option value="Pendiente" <?php if ($ticket['estado'] == "Pendiente") echo "selected"; ?>>Pendiente</option>
                    <option value="Finalizado" <?php if ($ticket['estado'] == "Finalizado") echo "selected"; ?>>Finalizado</option>
                </select>
            </div>
            <div class="col-md-9">
            <br>
                <label for="solucion" class="form-label">Solución:</label>
                <textarea name="solucion" class="form-control" rows="6"><?php echo $ticket['respuesta']; ?></textarea>
            </div>
            <div class="col-6">
            <br>
                <button type="submit" class="btn btn-success" onclick="alert('Ticket Actualizado');">Actualizar</button>
            </div>
            <div class="col-6">
            <br>
                <button type="button" onclick="window.history.back()" class="btn btn-primary">Volver al listado</button>
            </div>
        </form>
    </div>

</body>


</html>