<?php

session_start();

if(!isset($_SESSION["usuario"])){

    header("Location: /rebanho/index.php");

    exit();

}

require_once __DIR__."/../model/Usuario.php";

$model=new Usuario();

$dados=$model->buscarPorId($_SESSION["id"]);



?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Meu Perfil</title>

<link rel="stylesheet" href="/rebanho/app/css/style.css">

</head>

<body>

<?php include "menu.php"; ?>

<div class="content">

<h1>👤 Meu Perfil</h1>

<?php if(isset($_GET["ok"])){ ?>

<div class="alerta">

Dados atualizados com sucesso!

</div>

<br>

<?php } ?>

<div class="form-container">

<form method="POST"
action="/rebanho/salvar_perfil.php">

<div class="form-group">

<label>Nome</label>

<input
type="text"
name="nome"
value="<?= $dados["nome"] ?>"
required>

</div>

<div class="form-group">

<label>E-mail</label>

<input
type="email"
name="email"
value="<?= $dados["email"] ?>"
required>

</div>

<div class="form-group">

<label>Nova Senha</label>

<input
type="password"
name="senha"
placeholder="Deixe em branco para não alterar">

</div>

<div class="form-group">

<label>Confirmar Nova Senha</label>

<input
type="password"
name="confirmar_senha"
placeholder="Repita a nova senha">

</div>

<?php if(isset($_GET["erro"])){ ?>

<div class="alerta">

As senhas não coincidem.

</div>

<br>

<?php } ?>

<div class="form-buttons">

<button
class="btn"
type="submit">

💾 Salvar Alterações

</button>

</div>

</form>

</div>

</div>

</body>

</html>