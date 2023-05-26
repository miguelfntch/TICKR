<?php
session_start();
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
        <link rel="stylesheet" href="css/estilo.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link rel="shortcut icon" href="img/grupo4Logo.png" type="image/x-icon">
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="functions.js"></script>
        <link rel="stylesheet" href="css/bienvenida.css">
        <title>Panel administración | TICKR</title>
        <style>
            .imagen-port a {
            display: block;
            /* hace que el elemento de ancla sea un bloque para que ocupe todo el ancho del contenedor */
            color: inherit;
            /* hereda el color de texto del elemento envuelto */
            text-decoration: none;
            /* elimina cualquier decoración de enlace */
            }
        </style>

    </head>

    <body>
        <nav>
            <h1 id="title">TICKR</h1>
            <a href="index.html">Inicio</a>           
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
    <main>
        <div class="contenedor">
            <h2 class="titulo">Panel Administrativo</h2><hr>
            <div class="galeria-port">



                <div class="imagen-port">
                    <h6 class="">Administrar usuarios</h6>
                    <img src="img/administrarusers.png" alt="" id=''>
                    <div class="hover-galeria" id="myImage1">
                    <img src="img/iconotarget.png" alt="">
                    <p>Usuarios</p>
                </div>
            </div>

            <script>
                // Obtener la referencia de la imagen
                const myImage1 = document.getElementById("myImage1");

                // Agregar un evento de clic a la imagen
                myImage1.addEventListener("click", function() {
                // Redirigir al usuario a la página deseada
                window.location.href = "bienvenida.php";
                });
            </script>

            <div class="imagen-port">
                <h6 class="">Administrar tickets</h6>
                <img src="img/administrartickets.jpg" alt="">
                <div class="hover-galeria" id="myImage2">
                <img src="img/iconotarget.png" alt="">
                <p>Tickets</p>
                </div>
            </div>

            <script>
                // Obtener la referencia de la imagen
                const myImage2 = document.getElementById("myImage2");

                // Agregar un evento de clic a la imagen
                myImage2.addEventListener("click", function() {
                // Redirigir al usuario a la página deseada
                window.location.href = "listadoTickets.php";
                });
            </script>

            
            </div>

            
            </div>
            </div>
        </div>
    </main>
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