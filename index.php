<?php
session_start();
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
    <script>
        // FUNCION EN JavaScript PARA VALIDAD DESDE EL LADO CLIENTE
        function validarFormulario() {
            var email = document.forms["loginForm"]["email"].value;
            var passwd = document.forms["loginForm"]["passwd"].value;
            if (email == "" || passwd == "") {
                alert("Por favor, introduce tu correo electrónico y contraseña");
                return false;
            }
        }
    </script>
</head>

<body>
    <?php
    if (isset($_GET["mensaje"])) {
        echo "<h3 class='message'>" . htmlspecialchars($_GET["mensaje"]) . "</h3>";
    }
    ?>
    <!-- FORMULARIO LOGIN Y REGISTER -->
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">

        <div class="signup">
            <form action="comprobarForm.php" method="post" name="signupForm">
                <label for="chk" aria-hidden="true">Registrarse</label>
                <input type="text" name="user" placeholder="Usuario" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="passwd" placeholder="Contraseña" required="">
                <input type="submit" value="Registrarse" name="submit_signup">
            </form>
        </div>

        <div class="login">
            <form action="comprobarForm.php" method="post" name="loginForm" onsubmit="return validarFormulario()">
                <label for="chk" aria-hidden="true">Iniciar sesión</label>
                <input type="email" name="email" placeholder="Email" required="">
                <input type="password" name="passwd" placeholder="Contraseña" required="">
                <input type="submit" value="Entrar" name="submit_login">
            </form>
        </div>
    </div>

</body>

</html>