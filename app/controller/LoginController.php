<?php

require_once __DIR__ . "/../model/Usuario.php";

class LoginController
{

    public function login()
    {

        session_start();

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $email = trim($_POST["email"]);
            $senha = trim($_POST["senha"]);

            $usuarioModel = new Usuario();

            $usuario = $usuarioModel->autenticar($email, $senha);

            if ($usuario) {

                $_SESSION["id"] = $usuario["id"];
                $_SESSION["nome"] = $usuario["nome"];
                $_SESSION["email"] = $usuario["email"];

                // Mantém compatibilidade com o restante do sistema
                $_SESSION["usuario"] = $usuario["nome"];

                header("Location: /rebanho/dashboard.php");
                exit();

            } else {

                header("Location: /rebanho/app/view/login.php?erro=1");
                exit();

            }

        }

    }

    public function logout()
    {

        session_start();

        session_destroy();

        header("Location: /rebanho/app/view/login.php");
        exit();

    }

}