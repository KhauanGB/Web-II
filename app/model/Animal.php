<?php

require_once __DIR__ . "/../../config/database.php";

class Animal {

    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    // =========================
    // SALVAR
    // =========================

    public function salvar(
        $numero_brinco,
        $nome,
        $raca,
        $sexo,
        $data_nascimento
    ) {

        $sql = "INSERT INTO animais 
                (numero_brinco, nome, raca, peso, sexo, data_nascimento)
                VALUES 
                (:numero_brinco, :nome, :raca, :peso, :sexo, :data_nascimento)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":numero_brinco", $numero_brinco);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":raca", $raca);
        $stmt->bindParam(":peso", $peso);
        $stmt->bindParam(":sexo", $sexo);
        $stmt->bindParam(":data_nascimento", $data_nascimento);

        return $stmt->execute();
    }

    // =========================
    // BUSCAR POR ID
    // =========================

    public function buscarPorId($id) {

        $sql = "SELECT * FROM animais WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);

        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    // =========================
    // BUSCAR POR BRINCO
    // =========================

    public function buscarPorBrinco($numero_brinco) {

    $sql = "SELECT * FROM animais 
            WHERE numero_brinco LIKE :numero_brinco";

    $stmt = $this->conn->prepare($sql);

    $busca = "%" . $numero_brinco . "%";

    $stmt->bindParam(":numero_brinco", $busca);

    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // =========================
    // ATUALIZAR
    // =========================

    public function atualizar(
        $id,
        $numero_brinco,
        $nome,
        $raca,
        $peso,
        $sexo,
        $data_nascimento
    ) {

        $sql = "UPDATE animais SET
                numero_brinco = :numero_brinco,
                nome = :nome,
                raca = :raca,
                peso = :peso,
                sexo = :sexo,
                data_nascimento = :data_nascimento
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":numero_brinco", $numero_brinco);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":raca", $raca);
        $stmt->bindParam(":peso", $peso);
        $stmt->bindParam(":sexo", $sexo);
        $stmt->bindParam(":data_nascimento", $data_nascimento);

        return $stmt->execute();
    }

    // =========================
    // LISTAR
    // =========================

    public function listar() {

        $sql = "SELECT * FROM animais ORDER BY id DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =========================
    // EXCLUIR
    // =========================

    public function excluir($id) {

    $sql = "DELETE FROM animais WHERE id = :id";

    $stmt = $this->conn->prepare($sql);

    $stmt->bindParam(":id", $id);

    return $stmt->execute();

    }

    // =========================
    // PESO TOTAL
    // =========================

    public function pesoTotal(){

    $sql = "SELECT SUM(peso) AS total
            FROM animais";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    return $resultado["total"] ?? 0;
}

    // =========================
    // DASHBOARD
    // =========================

    public function dashboard() {

    $sql = "SELECT 
                COUNT(*) as total,
                SUM(CASE WHEN sexo = 'Macho' THEN 1 ELSE 0 END) as machos,
                SUM(CASE WHEN sexo = 'Fêmea' THEN 1 ELSE 0 END) as femeas,
                AVG(peso) as peso_medio
            FROM animais";

    $stmt = $this->conn->prepare($sql);

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}


}
?>