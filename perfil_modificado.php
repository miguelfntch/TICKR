<?php
session_start();
include 'conexion.php';
//Si se quiere subir una imagen
   //Recogemos el archivo enviado por el formulario
   $archivo = $_FILES['archivo']['name'];
   $id_usuario = $_POST['id'];
   $nombre = $_POST['nombre'];
   $correo = $_POST['correo'];
   $usuario = $_POST['usuario'];
   $contraseña = $_POST['contraseña'];
   //Si el archivo contiene algo y es diferente de vacio
   if (isset($archivo) && $archivo != "") {
      //Obtenemos algunos datos necesarios sobre el archivo
      $tipo = $_FILES['archivo']['type'];
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
     if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg")
          || strpos($tipo, "jpg") || strpos($tipo, "png")) && ($tamano < 2000000))) {
        echo '<div><b>Error. La extensión o el tamaño de los archivos no es correcta.<br/>
        - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.</b></div>';
     }
     else {
        //Si la imagen es correcta en tamaño y tipo
        //Se intenta subir al servidor
        $query = "UPDATE usuarios SET imagen_url = 'img/$archivo', nombre='$nombre', correo='$correo', 
        usuario='$usuario', contraseña='$contraseña' WHERE id_usuario = $id_usuario";
        if (move_uploaded_file($temp, 'img/'.$archivo)) {
            //Se actualiza la imagen de perfil del usuario
            if (mysqli_query($conexion, $query)) {
                //Cambiamos los permisos del archivo a 777 para poder modificarlo posteriormente
                chmod('img/'.$archivo, 0777);
                //Mostramos el mensaje de que se ha subido co éxito
                //Mostramos la imagen subida
                //Guardamos la ruta en la variable $_SESSION
                $_SESSION['imagen_url'] = "img/$archivo";
                $_SESSION['nom_usuario'] = $usuario;
                header("Refresh:0.5; url=panel_usuario.php");
            }
            
        } else {
           //Si no se ha podido subir la imagen, mostramos un mensaje de error
           echo '<div><b>Ocurrió algún error al subir el fichero. No pudo guardarse.</b></div>';
        }
      }
   } else {
        $query = "UPDATE usuarios SET nombre='$nombre', correo='$correo', usuario='$usuario', 
        contraseña='$contraseña' WHERE id_usuario = $id_usuario";
        if (mysqli_query($conexion, $query)) {
            $_SESSION['nom_usuario'] = $usuario;
            header("Location: panel_usuario.php");
        }
   }
   
