<?php
    include 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nombre = $_POST['nombre'];
	$correo = $_POST['correo'];
	$usuario = $_POST['usuario'];
	$contraseña = $_POST['contraseña'];


    $query = "INSERT INTO usuarios(nombre, correo, usuario, contraseña) 
              VALUES('$nombre','$correo','$usuario','$contraseña')";

///////////////////////////////////////////////////////////////////////////////////////////////////
    

    //Verificar que el CORREO no se repita en el registro//
    $verificar_correo = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo'");

    if(mysqli_num_rows($verificar_correo) > 0){
        echo '
            <script>
                alert("Este correo ya está registrado, intenta con otro diferente.");
                window.location = "registro.html";
            </script>
        ';
        //Para que no se ejecute el codigo de abajo ponemos exit()//
        exit();
    }

    //Verificar que el USUARIO no se repita en el registro//
    $verificar_usuario = mysqli_query($conexion, "SELECT * FROM usuarios WHERE usuario='$usuario'");
    if(mysqli_num_rows($verificar_usuario) > 0){
        echo '
            <script>
                alert("Este usuario ya está registrado, intenta con otro diferente.");
                window.location = "registro.html";
            </script>
        ';
        //Para que no se ejecute el codigo de abajo ponemos exit()//
        exit();
    }
///////////////////////////////////////////////////////////////////////////////////////////////////

 /*CONTROL PARA VER SI EL USUARIO SE HA REGISTRADO CORRECTAMENTE. */
$ejecutar = mysqli_query($conexion, $query);

	if ($ejecutar) {
        echo '
        <script>
            alert("Se ha registrado correctamente.");
            window.location = "login.html";
        </script>
    ';
	} else {		
        echo '
        <script>
            alert("Error: Inténtelo de nuevo, usuario no almacenado.");
            window.location = "registro.html";
        </script>
    ';
	}
}
mysqli_close($conexion);
?>