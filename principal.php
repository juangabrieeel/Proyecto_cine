<?php
session_start();
require_once("config/PDOConfig.php");
require_once("function/funciones.php");
require_once("models/Clientes.php");
require_once("models/Cines.php");

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
    <link rel="stylesheet" href="assets/home.css">

    <style>
        /* Estilos para los botones */
        #botonesContainer {
            position: absolute;
            top: 20px;
            right: 25px;
            display: flex;

        }

        #botonDarDeBaja,
        #botonActualizarDatos {
            padding: 10px 30px;
            font-size: 14px;
            border: none;
            cursor: pointer;
        }

        #botonDarDeBaja {
            background-color: #e74c3c;
            color: white;

        }

        #botonActualizarDatos {
            background-color: #2ecc71;
            color: white;
        }
    </style>
</head>

<body>
    <div id="botonesContainer">
        <!-- Botón "Dar de baja" -->
        <form action="darBaja.php" method="post">
            <input type="submit" id="botonDarDeBaja" name="submitDarDeBaja" value="Dar de baja">
        </form>

        <!-- Botón "Actualizar datos" -->
        <form action="actualizarDatos.php" method="post">
            <input type="submit" id="botonActualizarDatos" name="submitActualizarDatos" value="Actualizar datos">
        </form>
    </div>

    <h2>¡Hola,
        <?php echo $_SESSION['nombreCliente'] ?>!
    </h2>

    <form action="asientos.php" method="post">
        <label>Elige el cine que más te guste</label>
        <select name="cines">
            <?php //Mostramos los cines
            foreach (Cines::obtenerFilasCine() as $cine) {
                echo "<option value='" . $cine['nombre'] . "'>" . $cine['nombre'] . "</option>";
            }
            ?>
        </select><br />
        <input type="submit" value="Elegir asientos"><br />
    </form>
</body>

</html>