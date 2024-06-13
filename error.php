<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Error</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/error.css">
</head>

<body>
    <?php
    if (isset($_GET['mensaje'])) {
        echo "<h2>Error: " . htmlspecialchars($_GET['mensaje']) . "</h2><img src='assets/img/sad.png' alt='Error'>";
    }
    ?>
    <a href="cerrarSesion.php">Cerrar Sesión</a>
</body>

</html>