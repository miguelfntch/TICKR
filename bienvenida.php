<?php
    session_start();
	require("conexion.php");
    if (!isset($_SESSION['id_usuario']) && $_SESSION['tipo_usuario']==0){
		header("Location: login.html");
	} else if ($_SESSION['tipo_usuario']==0) {
		header("Location: login.html");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<link rel="shortcut icon" href="img/grupo4Logo.png" type="image/x-icon">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/18.0.0/classic/ckeditor.js"></script>
	<link rel="stylesheet" href="css/bienvenida.css">
    <script src="functions.js"></script>	
    <title>Listado usuarios | TICKR</title>
</head>
<body>
	<nav>
        <h1 id="title">TICKR</h1>
        <a href="index.html">Inicio</a>           
        <a href="admin_view.php">Administración</a>
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
	<div class="container">
	<?php
	$usuarios = mysqli_query($conexion, "SELECT * FROM usuarios");
	echo "<h2 id='header'>Usuarios</h2><hr>";
	if ((mysqli_num_rows($usuarios)) == 0) {
		echo "No se encuentran usuarios<br>";
	} else {
		echo "<div id='tabla'>
				<table>
					<form method='post' action='borrar_usuarios.php'>
						<tr class='header-row'>
							<th>ID</th>
							<th style='text-align:left'>NOMBRE</th>
							<th style='text-align:left'>CORREO</th>
							<th style='text-align:left'>USUARIO</th>
							<th style='text-align:left'>CONTRASEÑA</th>
							<th>ADMIN</th>
							<th>MODIFICAR</th>
							<th>BORRAR</th>
						</tr>";
						while($fila = mysqli_fetch_array($usuarios)) {
							extract($fila);
							if($tipo_usuario == 1){
								$admin = "<div id='check-icon'><i class='bi bi-check-lg'></i></div>";
							} else {
								$admin = "<div id='x-icon'><i class='bi bi-x-lg'></i></div>";
							}
							echo "<tr>
									<td style='width:7%;text-align:center;'>$id_usuario</td>
									<td style='width:20%;'>$nombre</td>
									<td style='width:20%;'>$correo</td>
									<td style='width:15%;'>$usuario</td>
									<td style='width:12%;'>$contraseña</td>
									<td style='width:7%;text-align:center;'>$admin</td>";
									echo "<td style='text-align:center'><a href='modificar_usuario.php?id_usuario=$id_usuario'>Modificar</a></td>
									<td style='text-align:center'><input type='checkbox' name='borrar[]' value='$id_usuario'></td>
								</tr>";
						}
						echo "<tr>
								<td colspan='8' style='text-align:right;'><input class='btn btn-danger' id='btn-borrar-form' type='submit' value='Borrar'></td>
							</tr>
					</form>
				</table>
			</div>";
	}

	?>
	<a id="btnAtrasTicket" type="button" class="btn btn-primary" href='admin_view.php'>Atrás</a>
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


