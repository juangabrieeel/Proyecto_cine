<?php
session_start();

// Verificar si la sesion está iniciada
if (!isset($_SESSION['iniciada'])) {
    header("Location: index.php");
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;

// Incluimos la libreria de PHPMailer
require 'QR/PHPMailer/src/PHPMailer.php';
require 'QR/PHPMailer/src/SMTP.php';


// Recuperamos los datos del formulario
$nombreCliente = $_SESSION["nombreCliente"];
$cine = $_SESSION["cine"];
$email = $_SESSION['emailUsuario'];
$asiento = $_GET['asiento'];

// Creamos una instancia de PHPMailer
if (!empty($email)) {
    $mail = new PHPMailer;

    // Establecemos la ruta a la imagen del codigo QR
    $codigo_qr = "QR/qrcodigo/" . $asiento . ", " .  $cine . ", " . $nombreCliente . ".png";

    // Configuramos la libreria PHPMailer
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'joseantonioleonlopez206@gmail.com';
    $mail->Password = 'jikl tryt dwcl aidp';
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Configuramos el correo
    $mail->setFrom('joseantonioleonlopez206@gmail.com', 'Cines Jose Antonio y Juan Gabriel');
    $mail->addAddress($email, $nombreCliente);

    // Escribimos el contenido del correo
    $mail->Subject = 'Entrada de cine';
    $mail->Body = "Hola $nombreCliente, te confirmamos tu entrada para $cine. 
        \nEl asiento es $asiento.\nAquí tienes el código QR para acceder.\n";

    // Agregamos la imagen del codigo QR de forma adjunta al email
    $mail->addAttachment($codigo_qr);

    try {
        // Enviar el email
        if ($mail->send()) {
            header("Location: confirmacionCorreo.php?mensaje=Se ha enviado el correo correctamente");
        } else {
            throw new Exception($mail->ErrorInfo);
        }
    } catch (Exception $e) {
        header("Location: index.php?mensaje=" . $e->getMessage());
        exit();
    }

}
?>