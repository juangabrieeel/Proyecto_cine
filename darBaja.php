<?php
// Importa el archivo de funciones
require_once("function/funciones.php");
require_once("config/PDOConfig.php");
require_once("models/Clientes.php");

// Inicia la sesión
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cine</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/darBaja.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    <title>Dar de baja</title>
</head>

<body>
    <h1>Has dado de baja correctamente al usuario</h1>
</body>

</html>
<?php
if (!isset($_SESSION['iniciada'])) {
    header("Location: index.php");
    exit;
}
// Verifica si se ha enviado el formulario
if (isset($_POST['submitDarDeBaja'])) {
    $emailUsuario = $_SESSION['emailUsuario'];
    $pdo = PDOConfig::crearPdo();

    // Verifica si el email es válido antes de intentar eliminar
    if (emailValido($emailUsuario)) {
        // Llama a la función para eliminar al usuario por email
        if (Clientes::eliminarClientePorEmail($pdo, $emailUsuario)) {
            // Destruye la sesión
            session_destroy();

            // Redirige al index.php después de un tiempo
            header("refresh:5;url=index.php");
            echo "<h2>Serás redirigido al inicio en 5 segundos. Si no, haz clic <a href='index.php'>aquí</a>.</h2>";
            exit;
        } else {
            echo "Error al eliminar el cliente.";
        }
    } else {
        echo "Email no válido.";
    }
}
