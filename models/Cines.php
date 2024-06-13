<?php

class Cines
{
    private string $nombre;
    private string $poblacion;
    private int $id;

    // Constructor de la clase Cines
    public function __construct(string $nombre, string $poblacion)
    {
        $this->nombre = $nombre;
        $this->poblacion = $poblacion;
    }

    // Métodos getters y setters para cada atributo
    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function getPoblacion(): string
    {
        return $this->poblacion;
    }

    public function setPoblacion(string $poblacion): self
    {
        $this->poblacion = $poblacion;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    // Método para obtener una representación de cadena del objeto
    public function __toString(): string
    {
        return "Cine: {$this->nombre}, Población: {$this->poblacion}, ID: {$this->id}";
    }

    // Funcion para obtener las filas de cine
    public static function obtenerFilasCine(): array
    {
        $pdo = PDOConfig::crearPdo(); //Creamos el PDO
        $filasCine = [];
        $stmt = $pdo->query("SELECT * FROM Cines");

        while ($fila = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $filasCine[] = $fila;
        }

        return $filasCine;
    }
}
