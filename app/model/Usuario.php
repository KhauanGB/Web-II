<?php

require_once __DIR__ . "/../../config/database.php";

class Usuario
{

    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->conectar();
    }

    public function autenticar($email, $senha)
    {

        $sql = "SELECT * FROM usuarios WHERE email = ? LIMIT 1";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$usuario) {
            return false;
        }

        // Se a senha estiver criptografada
        if (password_verify($senha, $usuario["senha"])) {
            return $usuario;
        }

        // Compatibilidade caso ainda esteja em texto simples
        if ($senha === $usuario["senha"]) {
            return $usuario;
        }

        return false;
    }

    public function buscarPorId($id)
    {

        $sql = "SELECT * FROM usuarios WHERE id=?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    public function atualizar($id,$nome,$email,$senha=null)
    {

        if(!empty($senha)){

            $senha = password_hash($senha,PASSWORD_DEFAULT);

            $sql="UPDATE usuarios
                SET nome=?, email=?, senha=?
                WHERE id=?";

            $stmt=$this->conn->prepare($sql);

            return $stmt->execute([
                $nome,
                $email,
                $senha,
                $id
            ]);

        }

        $sql="UPDATE usuarios
            SET nome=?, email=?
            WHERE id=?";

        $stmt=$this->conn->prepare($sql);

        return $stmt->execute([
            $nome,
            $email,
            $id
        ]);

    }

}