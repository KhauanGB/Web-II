<?php

require_once __DIR__."/../model/Usuario.php";

class UsuarioController{

    public function salvar(){

        session_start();

        $usuario=new Usuario();

        if($_POST["senha"] != $_POST["confirmar_senha"]){

        header("Location: /rebanho/app/view/perfil.php?erro=1");

        exit();

    }

        $usuario->atualizar(

            $_SESSION["id"],

            $_POST["nome"],

            $_POST["email"],

            $_POST["senha"]

        );

        $_SESSION["nome"]=$_POST["nome"];
        $_SESSION["email"]=$_POST["email"];
        $_SESSION["usuario"]=$_POST["nome"];

        header("Location: /rebanho/app/view/perfil.php?ok=1");

        exit();

    }

}