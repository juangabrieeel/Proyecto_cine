<?php

class PDOConfig extends PDO
{
    private const DB_HOST = 'localhost';
    private const DB_NAME = 'cine';
    private const DB_USER = 'root';
    private const DB_PASS = '';

    public function __construct()
    {
        $dsn = "mysql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;

        // Configurar opciones de PDO para el manejo de errores y el juego de caracteres
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4 COLLATE utf8mb4_unicode_ci"
        ];

        try {
            parent::__construct($dsn, self::DB_USER, self::DB_PASS, $options);
        } catch (PDOException $e) {
            throw new PDOException("Error al conectar a la base de datos: " . $e->getMessage());
        }
    }

    public static function crearPdo()
    { //Método para crear pdo
        $pdo = new \PDO("mysql:host=" . self::DB_HOST. ";dbname=" . self::DB_NAME, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}


?>