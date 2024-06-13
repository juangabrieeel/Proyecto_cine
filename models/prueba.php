<?php
/*
XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
ESTE ARCHIVO ES SOLO PARA PROBAR LAS CLASES
XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
*/
// Incluye la definición de la clase Cliente
require_once 'CineLibrary.php';

try {
    // Configuración de la conexión a la base de datos
    $pdo = new \PDO("mysql:host=localhost;dbname=cine", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Obtener filas de cines
    $filasCine = CineLibrary::obtenerFilasCine($pdo);
    echo json_encode($filasCine, JSON_PRETTY_PRINT);


    // Obtener usuario por email
    echo "<br>";
    $emailBuscado = 'correo@example.com';
    if (CineLibrary::usuarioExiste($pdo, $emailBuscado)) {
        // Haz algo con $usuarioEncontrado
        echo "Usuario encontrado.";
    } else {
        echo "Usuario no encontrado.";
    }

} catch (\PDOException $e) {
    // Manejar la excepción según tus necesidades
    echo "Error de base de datos: " . $e->getMessage();
}
