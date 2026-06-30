<?php

require_once __DIR__ . "/../../config/database.php";

class Vacina {

    private $conn;
    private $table = "vacinas";

    public function __construct() {

        $database = new Database();
        $this->conn = $database->conectar();

    }

    // LISTAR TODAS AS VACINAS
    public function listar() {

        $sql = "SELECT v.*, a.nome AS nome_animal
                FROM vacinas v
                INNER JOIN animais a
                ON v.animal_id = a.id
                ORDER BY v.data_vacina DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BUSCAR VACINA POR ID
    public function buscarPorId($id) {

        $sql = "SELECT * FROM vacinas
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // SALVAR NOVA VACINA
    public function salvar(
        $animal_id,
        $nome_vacina,
        $data_vacina,
        $proxima_vacinacao,
        $observacao
    ) {

        $sql = "INSERT INTO vacinas
                (
                    animal_id,
                    nome_vacina,
                    data_vacina,
                    proxima_vacinacao,
                    observacao
                )
                VALUES
                (
                    :animal_id,
                    :nome_vacina,
                    :data_vacina,
                    :proxima_vacinacao,
                    :observacao
                )";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":animal_id", $animal_id);
        $stmt->bindParam(":nome_vacina", $nome_vacina);
        $stmt->bindParam(":data_vacina", $data_vacina);
        $stmt->bindParam(":proxima_vacinacao", $proxima_vacinacao);
        $stmt->bindParam(":observacao", $observacao);

        return $stmt->execute();
    }

    // ATUALIZAR VACINA
    public function atualizar(
        $id,
        $animal_id,
        $nome_vacina,
        $data_vacina,
        $proxima_vacinacao,
        $observacao
    ) {

        $sql = "UPDATE vacinas
                SET

                animal_id = :animal_id,
                nome_vacina = :nome_vacina,
                data_vacina = :data_vacina,
                proxima_vacinacao = :proxima_vacinacao,
                observacao = :observacao

                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":animal_id", $animal_id);
        $stmt->bindParam(":nome_vacina", $nome_vacina);
        $stmt->bindParam(":data_vacina", $data_vacina);
        $stmt->bindParam(":proxima_vacinacao", $proxima_vacinacao);
        $stmt->bindParam(":observacao", $observacao);

        return $stmt->execute();
    }

    // EXCLUIR VACINA
    public function excluir($id) {

        $sql = "DELETE FROM vacinas
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    // CONTAR TOTAL DE VACINAS
   public function totalVacinas() {

    $sql = "SELECT COUNT(*) as total
            FROM vacinas";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado["total"];
}

    // VACINAS PRÓXIMAS
    public function proximasVacinas() {

    $sql = "SELECT
                a.nome AS animal,
                v.nome_vacina,
                v.proxima_vacinacao
            FROM vacinas v
            INNER JOIN animais a
                ON a.id = v.animal_id
            WHERE v.proxima_vacinacao
                BETWEEN CURDATE()
                AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)
            ORDER BY v.proxima_vacinacao";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

    // CONTAR TOTAL DE VACINAS PRÓXIMAS
    public function totalProximas() {

    $sql = "SELECT COUNT(*) AS total
            FROM vacinas
            WHERE proxima_vacinacao
            BETWEEN CURDATE()
            AND DATE_ADD(CURDATE(), INTERVAL 30 DAY)";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado["total"];
}

    // VACINAS VENCIDAS
    public function totalVencidas() {

    $sql = "SELECT COUNT(*) AS total
            FROM vacinas
            WHERE proxima_vacinacao < CURDATE()";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado["total"];
}


}