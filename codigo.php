<?php
require_once('QR/phpqrcode/qrlib.php');
session_start();

// Verificar si la sesion está iniciada
if (!isset($_SESSION['iniciada'])) {
    header("Location: index.php");
    exit;
}

// Información para el código QR
if (isset($_GET["asiento"])) {
$asiento = htmlspecialchars($_GET["asiento"]);

$cine = $_SESSION["cine"];
$nombreCliente = $_SESSION["nombreCliente"];

// Texto para el código QR
$qrText = "http://localhost/Cine/entrada.php?usuario=$nombreCliente&asiento=$asiento&cine=$cine";

//Guardamos el código QR
$ruta = "QR/qrcodigo/" . $asiento . ", " .  $cine . ", " . $nombreCliente . ".png";
QRcode::png($qrText, $ruta);
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Cine</title>
    </head>
    <body>
        <img src="<?php echo $ruta ?>" /><br/>
        <?php
        if (isset($_GET["mensaje"])) {
            echo "<p style='color:green;'>" . $_GET["mensaje"] . "</p>";
        }
    ?>
        <a href="codigopdf.php?asiento=<?php echo $asiento ?>">Descargar entrada en PDF</a><br />
        <a href="codigocorreo.php?asiento=<?php echo $asiento ?>">Enviar entrada por correo electrónico</a><br /><br />
        <a href="cerrarSesion.php">Cerrar Sesión</a>
    </body>
</html>

