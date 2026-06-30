<?php

require_once __DIR__ . "/../../config/database.php";

class Custo {

    private $conn;

    public function __construct(){

        $database = new Database();
        $this->conn = $database->conectar();

    }

    public function listar(){

        $sql = "SELECT c.*, a.nome AS nome_animal
                FROM custos c
                LEFT JOIN animais a
                ON c.animal_id = a.id
                ORDER BY c.data DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

    public function buscarPorId($id){

        $sql = "SELECT * FROM custos
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function salvar(
        $tipo,
        $descricao,
        $valor,
        $data,
        $animal_id
    ){

        $sql = "INSERT INTO custos
                (tipo, descricao, valor, data, animal_id)
                VALUES
                (:tipo, :descricao, :valor, :data, :animal_id)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":animal_id", $animal_id);

        return $stmt->execute();

    }

    public function atualizar(
        $id,
        $tipo,
        $descricao,
        $valor,
        $data,
        $animal_id
    ){

        $sql = "UPDATE custos SET

                tipo = :tipo,
                descricao = :descricao,
                valor = :valor,
                data = :data,
                animal_id = :animal_id

                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":tipo", $tipo);
        $stmt->bindParam(":descricao", $descricao);
        $stmt->bindParam(":valor", $valor);
        $stmt->bindParam(":data", $data);
        $stmt->bindParam(":animal_id", $animal_id);

        return $stmt->execute();

    }

    public function excluir($id){

        $sql = "DELETE FROM custos
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();

    }

    public function totalCustos(){

        $sql = "SELECT SUM(valor) AS total
                FROM custos";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute();

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        return $resultado["total"] ?? 0;

    }

    public function custosPorCategoria(){

    $sql = "SELECT
                tipo,
                SUM(valor) AS total
            FROM custos
            GROUP BY tipo
            ORDER BY total DESC";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

}