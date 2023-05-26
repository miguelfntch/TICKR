<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

session_start();
include_once("conexion.php");


$correo = $_POST["email"];
$asunto = $_POST["asunto"];
$descripcion = $_POST["mensaje"];
$id_ticket = $_POST['id'];
$respuesta = $_POST['solucion'];
$estado = $_POST['estado'];
$ultima_actividad = date("d-m-Y H:i", time());

$fields = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT usuario_id,fecha FROM ticket WHERE id_ticket = $id_ticket"));
$fecha = $fields['fecha'];
$fechaFormat = date("d-m-Y H:i", strtotime($fecha));
$usuario_id = $fields['usuario_id'];
$nom_usuario = mysqli_fetch_assoc(mysqli_query($conexion, "SELECT usuario FROM usuarios WHERE id_usuario = $usuario_id"))['usuario'];
$query = "UPDATE ticket SET ultima_actividad = current_timestamp, respuesta = '$respuesta', estado = '$estado' WHERE id_ticket = $id_ticket";

$mail = new PHPMailer(true);

if(!empty($id_ticket)) {
    if(mysqli_query($conexion, $query)) {
        echo "<script>
                    alert('Respuesta enviada')
              </script>";
              try {
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->SMTPDebug = 0;
                $mail->IsSMTP();
                $mail->CharSet = 'utf-8';
                $mail->Host = "smtp.gmail.com";
                
                $mail->SMTPAuth = true;
                $mail->Username = "miguel.fntch@gmail.com";
                $mail->Password = "ekpoonjhfasjlzki";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;
                $mail->AddAddress($correo);
                $mail->setFrom("miguel.fntch@gmail.com", "TICKR");
                $mail->isHTML(true);                                  // Set email format to HTML
                $mail->Subject = "Respuesta recibida: $asunto";
                $mail->Body    = "<hr>Ticket creado el $fechaFormat por $nom_usuario.<br><br>$descripcion<hr>Respuesta TICKR:<br><br>$respuesta<br><br>
                                  $ultima_actividad<br><br>TICKR<hr>";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                //echo "Mensaje enviado con exito.";
            } catch (Exception $e) {
                echo "Mensaje de Error: {$mail->ErrorInfo}";
            }
        header("Refresh:0.5; url=listadoTickets.php");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/grupo4Logo.png" type="image/x-icon">
    <title>Respuesta enviada! | TICKR</title>
</head>
</html>