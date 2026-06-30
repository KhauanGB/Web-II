<?php

class Database {

    private $host = "localhost";
    private $db_name = "rebanho_db";
    private $username = "root";
    private $password = "";
    private $port = "3307";

    public $conn;

    public function conectar() {

        $this->conn = null;

        try {

            $this->conn = new PDO(
                "mysql:host=" . $this->host .
                ";port=" . $this->port .
                ";dbname=" . $this->db_name,
                $this->username,
                $this->password
            );

            $this->conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );

        } catch(PDOException $exception) {

            echo "Erro de conexão: " . $exception->getMessage();

        }

        return $this->conn;

    }

}

?>