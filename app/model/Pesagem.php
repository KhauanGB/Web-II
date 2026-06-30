<?php

require_once __DIR__ . "/../../config/database.php";

class Pesagem {

    private $conn;
    private $table = "pesagens";

    public function __construct() {

        $database = new Database();
        $this->conn = $database->conectar();

    }

    // LISTAR TODAS AS PESAGENS
    public function listar() {

        $sql = "SELECT p.*, a.nome AS nome_animal
                FROM pesagens p
                INNER JOIN animais a
                ON p.animal_id = a.id
                ORDER BY p.data_pesagem DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    // BUSCAR PESAGEM POR ID
    public function buscarPorId($id) {

        $sql = "SELECT *
                FROM pesagens
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    // SALVAR PESAGEM
    public function salvar(
        $animal_id,
        $peso,
        $data_pesagem
    ) {

        $sql = "INSERT INTO pesagens
                (
                    animal_id,
                    peso,
                    data_pesagem
                )
                VALUES
                (
                    :animal_id,
                    :peso,
                    :data_pesagem
                )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":animal_id", $animal_id);
        $stmt->bindParam(":peso", $peso);
        $stmt->bindParam(":data_pesagem", $data_pesagem);

        $resultado = $stmt->execute();

        // Atualiza o peso atual do animal
        if ($resultado) {

            $sqlAnimal = "UPDATE animais
                          SET peso = :peso
                          WHERE id = :animal_id";

            $stmtAnimal = $this->conn->prepare($sqlAnimal);

            $stmtAnimal->bindParam(":peso", $peso);
            $stmtAnimal->bindParam(":animal_id", $animal_id);

            $stmtAnimal->execute();
        }

        return $resultado;
    }

    // ATUALIZAR PESAGEM
    public function atualizar(
        $id,
        $animal_id,
        $peso,
        $data_pesagem
    ) {

        $sql = "UPDATE pesagens
                SET

                animal_id = :animal_id,
                peso = :peso,
                data_pesagem = :data_pesagem

                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":animal_id", $animal_id);
        $stmt->bindParam(":peso", $peso);
        $stmt->bindParam(":data_pesagem", $data_pesagem);

        $resultado = $stmt->execute();

        // Atualiza peso atual do animal
        if ($resultado) {

            $sqlAnimal = "UPDATE animais
                          SET peso = :peso
                          WHERE id = :animal_id";

            $stmtAnimal = $this->conn->prepare($sqlAnimal);

            $stmtAnimal->bindParam(":peso", $peso);
            $stmtAnimal->bindParam(":animal_id", $animal_id);

            $stmtAnimal->execute();
        }

        return $resultado;
    }

    // EXCLUIR PESAGEM
    public function excluir($id) {

        $sql = "DELETE FROM pesagens
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

}
?>