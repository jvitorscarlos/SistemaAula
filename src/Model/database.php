<?php

class Database
{
    private $host = "localhost";
    private $database = "aulapdo";
    private $usuario = "root";
    private $senha = "";

    private $conn = null;

    public function conectar()
    {
        if ($this->conn === null) {

            $this->conn = new mysqli(
                $this->host,
                $this->usuario,
                $this->senha,
                $this->database
            );

            if ($this->conn->connect_error) {
                die("Erro na conexão: " . $this->conn->connect_error);
            }

            $this->conn->set_charset("utf8");
        }

        return $this->conn;
    }
}