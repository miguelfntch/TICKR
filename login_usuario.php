<?php 
    session_start();
    include 'conexion.php';

    $correo = $_POST['correo'];
    $contraseña = $_POST['password'];

    $validar_login = mysqli_query($conexion, "SELECT * FROM usuarios WHERE correo='$correo' and contraseña='$contraseña'");
    $campos_usuario = mysqli_fetch_assoc($validar_login);
    $tipo_usuario = $campos_usuario['tipo_usuario'];

    if (mysqli_num_rows($validar_login) > 0 && $tipo_usuario == 0){
        $_SESSION['id_usuario'] = $campos_usuario['id_usuario'];
        $_SESSION['correo'] = $correo;
        $_SESSION['nom_usuario'] = $campos_usuario['usuario'];
        $_SESSION['imagen_url'] = $campos_usuario['imagen_url'];
        $_SESSION['nombre_completo'] = $campos_usuario['nombre'];
        $_SESSION['tipo_usuario'] = $tipo_usuario;
        header("Location: panel_usuario.php");
    } else if (mysqli_num_rows($validar_login) > 0){
        $_SESSION['id_usuario'] = $campos_usuario['id_usuario'];
        $_SESSION['correo'] = $correo;
        $_SESSION['nom_usuario'] = $campos_usuario['usuario'];
        $_SESSION['imagen_url'] = $campos_usuario['imagen_url'];
        $_SESSION['nombre_completo'] = $campos_usuario['nombre'];
        $_SESSION['tipo_usuario'] = $tipo_usuario;
        header("Location: admin_view.php");
    } else if($_GET["prev"]) {
        header("Location: login.html");
    } else {
        echo '
            <script>    
                alert("Usuario no existe, por favor verifique los datos introducidos.");
                window.location = "login.html";
            </script>
        ';
        exit;
    }
?>
