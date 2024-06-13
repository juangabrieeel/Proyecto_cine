<?php
session_start();
require_once("config/PDOConfig.php");
require_once("function/funciones.php");
require_once("models/Clientes.php");

// Verificar si la sesión está iniciada
if (!isset($_SESSION['iniciada'])) {
    header("Location: index.php");
    exit;
}

// Verificar si se ha enviado el formulario de actualización
if (isset($_POST['actualizar'])) {
    // Obtener datos del formulario
    $nuevoUsuario = htmlspecialchars($_POST['user']);
    $nuevaContrasena = htmlspecialchars($_POST['passwd']);
    $emailUsuario = htmlspecialchars($_POST['email']);

    // Obtener el cliente actual desde la sesión
    $pdo = PDOConfig::crearPdo();
    $clienteActual = Clientes::obtenerClientePorEmail($pdo, $emailUsuario);

    // Verificar si el cliente existe y realizar la actualización
    if ($clienteActual instanceof Clientes) {
        $clienteActual->setUsuario($nuevoUsuario);

        // Verificar la contraseña actual
        $contrasenaActual = htmlspecialchars($_POST['contrasenaActual']);
        if (password_verify($contrasenaActual, $clienteActual->getPasswd())) {
            $clienteActual->setPasswd(password_hash($nuevaContrasena, PASSWORD_DEFAULT));

            if ($clienteActual->actualizarCliente($pdo)) {
                header("Location: index.php?message=Información actualizada correctamente");
            } else {
                header("Location: index.php?message=Error al actualizar la información del cliente");
            }
        } else {
            header("Location: index.php?message=Las contraseñas no coinciden");
        }
    } else {
        header("Location: index.php?message=Error: No se encontró el cliente actual");
    }
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
    <link rel="stylesheet" href="assets/index.css">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <!-- FORMULARIO PARA ACTUALIZAR INFORMACIÓN -->
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">
            <form action="actualizarDatos.php" method="post" name="signupForm">
                <label for="chk" aria-hidden="true">Actualizar información</label>
                <input type="text" name="user" placeholder="Usuario" required="">
                <input type="text" name="email" value="<?php echo htmlspecialchars($_SESSION['emailUsuario']); ?>"
                    style="display: none;">
                <input type="password" name="contrasenaActual" placeholder="Contraseña Actual" required="">
                <input type="password" name="passwd" placeholder="Nueva Contraseña" required="">
                <input type="submit" value="Actualizar" name="actualizar">
            </form>
        </div>
    </div>
</body>

</html>