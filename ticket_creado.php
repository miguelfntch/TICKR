<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';

session_start();
include_once("conexion.php");


$departamento = $_POST["departamento"];
$asunto = $_POST["asunto"];
$descripcion = $_POST["descripcion"];
$id = $_SESSION['id_usuario'];
$correo = $_SESSION['correo'];
$nom_usuario = $_SESSION['nom_usuario'];

$mail = new PHPMailer(true); // Creamos una instancia de PHPMailer que vamos a configurar mas abajo

$query = "INSERT INTO ticket (asunto, departamento, descripcion, respuesta, correo, usuario_id) 
          VALUES ('$asunto', '$departamento', '$descripcion', '', '$correo', '$id')";

if(!empty($id)) {
    if(mysqli_query($conexion, $query)) {  // Si el ticket se crea correctamente, se configura el mail y se envía
        echo "<script>
                    alert('Ticket creado correctamente')
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
                $mail->Password = "ekpoonjhfasjlzki";  // Token para integrar la app con Gmail
                //numnpfsfbttnogvu
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;
                $mail->AddAddress($correo); // Correo usuario
                $mail->setFrom("miguel.fntch@gmail.com", "TICKR");
                $mail->isHTML(true);                                  
                $mail->Subject = "Ticket creado: $asunto";
                $mail->Body    = "Estimado/a sr/a $nom_usuario,<br><br>Su ticket se ha creado correctamente. Nuestros expertos 
                                  revisarán su caso y le responderán enseguida. Gracias por su confianza.<br><br>
                                  
                                  Dpto. Atención al Cliente<br>
                                  TICKR<br><br><hr><br>
                                  $descripcion.";
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                $mail->send();
                //echo "Mensaje enviado con exito.";
            } catch (Exception $e) {
                echo "Mensaje de Error: {$mail->ErrorInfo}";
            }
        header("Refresh:0.5; url=panel_usuario.php");
    }
}
?>