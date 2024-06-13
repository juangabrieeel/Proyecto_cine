<?php

class Entradas
{
    private int $idEntrada;
    private int $asiento;
    private int $idCliente;
    private int $idCine;

    // Constructor de la clase Entradas
    public function __construct(int $idCliente, int $asiento, int $idCine)
    {
        $this->idCliente = $idCliente;
        $this->asiento = $asiento;
        $this->idCine = $idCine;
    }

    // Getters y Setters para los atributos
    public function getIdCliente(): int
    {
        return $this->idCliente;
    }

    public function setIdCliente(int $idCliente): self
    {
        $this->idCliente = $idCliente;
        return $this;
    }

    public function getAsiento(): int
    {
        return $this->asiento;
    }

    public function setAsiento(int $asiento): self
    {
        $this->asiento = $asiento;
        return $this;
    }

    public function getIdCine(): int
    {
        return $this->idCine;
    }

    public function setIdCine(int $idCine): self
    {
        $this->idCine = $idCine;
        return $this;
    }

    public function getIdEntrada(): int
    {
        return $this->idEntrada;
    }

    public function setIdEntrada(int $idEntrada): self
    {
        $this->idEntrada = $idEntrada;
        return $this;
    }
}
