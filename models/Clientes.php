<?php

class Clientes
{
    private string $usuario;
    private string $passwd;
    private string $email;
    private int $id;

    // Constructor de la clase Clientes
    public function __construct(string $usuario, string $passwd, string $email)
    {
        $this->usuario = $usuario;
        $this->passwd = $passwd;
        $this->email = $email;
    }

    // Métodos getters y setters para cada atributo

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getUsuario(): string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getPasswd(): string
    {
        return $this->passwd;
    }

    public function setPasswd(string $passwd): self
    {
        $this->passwd = $passwd;
        return $this;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    // Método para insertar el cliente en la base de datos
    public function insertarCliente(\PDO $pdo): bool
    {
        try {
            $stmt = $pdo->prepare("INSERT INTO Clientes (usuario, passwd, email) VALUES (:usuario, :passwd, :email)");
            $stmt->bindParam(':usuario', $this->usuario);
            $stmt->bindParam(':passwd', $this->passwd);
            $stmt->bindParam(':email', $this->email);

            if ($stmt->execute()) {
                $this->id = $pdo->lastInsertId();
                return true;
            } else {
                return false;
            }
        } catch (\PDOException $e) {
            return false;
        }
    }

    // Método para actualizar el cliente en la base de datos
    public function actualizarCliente(\PDO $pdo): bool
    {
        // Verificar si el usuario tiene un ID asignado
        if ($this->id) {
            $stmt = $pdo->prepare("UPDATE Clientes SET usuario = :nuevoUsuario, passwd = :nuevaContrasena WHERE id = :id");
            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':nuevoUsuario', $this->usuario);
            $stmt->bindParam(':nuevaContrasena', $this->passwd);

            return $stmt->execute();
        } else {
            // Si el usuario no tiene un ID asignado, no se puede actualizar
            return false;
        }
    }


    // Funcion para obtener el email de un cliente
    public static function clienteExiste(\PDO $pdo, string $email)
    {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM Clientes WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        return $stmt->fetchColumn();
    }

    // Funcion para obtener un cliente por su email
    public static function obtenerClientePorEmail(\PDO $pdo, string $email)
    {
        $stmt = $pdo->prepare("SELECT * FROM Clientes WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $resultado = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($resultado) {
            $cliente = new Clientes($resultado['usuario'], $resultado['passwd'], $resultado['email']);
            $cliente->setId($resultado['id']);
            return $cliente;
        } else {
            return null; // No se encontró ningún cliente con ese email
        }
    }

    // Método para eliminar el cliente en la base de datos
    public static function eliminarClientePorEmail(\PDO $pdo, string $email): bool
    {
        try {
            $stmt = $pdo->prepare("DELETE FROM Clientes WHERE email = :email");
            $stmt->bindParam(':email', $email);
            return $stmt->execute();
        } catch (\PDOException $e) {
            return false;
        }
    }
}
