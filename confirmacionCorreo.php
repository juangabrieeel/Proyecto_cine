<?php
session_start();

// Verificar si la sesion está iniciada
if (!isset($_SESSION['iniciada'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cine</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="">
</head>

<body>
    <?php
    if (isset($_GET["mensaje"])) {
        echo "<p style='color:green;'>" . $_GET["mensaje"] . "</p>";
    }
    ?>
    <a href="principal.php">Página principal</a><br>
    <a href="cerrarSesion.php">Cerrar Sesión</a>
</body>

</html>