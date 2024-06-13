<?php
session_start();
require_once("config/PDOConfig.php");
require_once("function/funciones.php");
require_once("models/Clientes.php");

// COMPROBAR FORMULARIO DE SIGNUP
if (isset($_POST['submit_signup'])) {
    if (isset($_POST['user']) && isset($_POST['email']) && isset($_POST['passwd'])) {
        // Creamos las variables y las pasamos por htmlspecialchars
        $user = htmlspecialchars($_POST['user']);
        $email = htmlspecialchars($_POST['email']);
        $passwd = htmlspecialchars($_POST['passwd']);

        if (empty($user) || empty($email) || empty($passwd)) {
            header('Location: index.php?mensaje=No has introducido todos los datos');
            exit;
        }

        // Verificamos el formato del email
        if (!emailValido($email)) {
            header('Location: index.php?mensaje=Email incorrecto');
            exit;
        }

        try {
            $pdo = PDOConfig::crearPdo(); // Creamos el PDO
        } catch (Exception $e) {
            header('Location: error.php?mensaje=' . $e->getMessage());
        }

        // Verificamos si el cliente ya existe
        if (Clientes::clienteExiste($pdo, $email)) {
            header('Location: index.php?mensaje=Ya existe un cliente registrado con ese email');
            exit;
        }

        // Encriptamos la contraseña
        $passwdHash = password_hash($passwd, PASSWORD_DEFAULT);

        try { // Registramos el usuario
            $cliente = new Clientes($user, $passwdHash, $email); // Creamos el objeto usuario con los parámetros del usuario
            $cliente->insertarCliente($pdo); // Insertar el cliente en la base de datos

            // Iniciar sesión
            $_SESSION['iniciada'] = true;
            $_SESSION['nombreCliente'] = $user;
            $_SESSION['emailUsuario'] = $email;
            header('Location: principal.php');
            exit;
        } catch (Exception $e) {
            header('Location: error.php?mensaje=' . $e->getMessage());
        }
    } else {
        header('Location: index.php?mensaje=Por favor, introduce tu correo electrónico y contraseña');
    }
}

//COMPROBAR FORMULARIO DE LOGIN
if (isset($_POST['submit_login'])) {
    if (isset($_POST['email']) && isset($_POST['passwd'])) {
        $email = htmlspecialchars($_POST['email']);
        $passwd = htmlspecialchars($_POST['passwd']);
        if (!empty($email) && !empty($passwd)) {
            try { //Comprobamos el usuario
                $pdo = PDOConfig::crearPdo(); //Creamos el PDO
                if (Clientes::clienteExiste($pdo, $email)) {
                    $cliente = Clientes::obtenerClientePorEmail($pdo, $email);
                    if (password_verify($passwd, $cliente->getPasswd())) {
                        // Iniciar sesión
                        $_SESSION['iniciada'] = true;
                        $_SESSION['nombreCliente'] = $cliente->getUsuario();
                        $_SESSION['emailUsuario'] = $email;
                        header('Location: principal.php');
                        exit;
                    } else {
                        header('Location: index.php?mensaje=Contraseña incorrecta');
                        exit;
                    }
                } else {
                    header('Location: index.php?mensaje=Cliente no encontrado');
                    exit;
                }
            } catch (Exception $e) {
                header('Location: error.php?mensaje=' . $e->getMessage());
            }
        } else {
            header('Location: index.php?mensaje=Por favor, introduce tu correo electrónico y contraseña');
        }
    }
}
