<?php
session_start();
require_once("config/PDOConfig.php");
require_once("function/funciones.php");
require_once("models/Clientes.php");
require_once("models/Cines.php");
require_once("models/Entradas.php");

// Verificar si la sesion está iniciada
if (!isset($_SESSION['iniciada'])) {
    header("Location: index.php");
    exit;
}
$cine = $_POST['cines'];
$_SESSION['cine'] = $cine;
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cine</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/seating.css">
</head>

<body>
    <h1>Cine: <?php echo $_SESSION['cine']?></h1>
    <h2>Selecciona el asiento que más te guste</h2>
    <table border="1">
        <thead>
            <tr>
                <th colspan="2">Pantalla</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><a href="codigo.php?asiento=1">1</a></td>
                <td><a href="codigo.php?asiento=2">2</a></td>
            </tr>
            <tr>
                <td><a href="codigo.php?asiento=3">3</a></td>
                <td><a href="codigo.php?asiento=4">4</a></td>
            </tr>
        </tbody>
    </table>

</body>

</html>