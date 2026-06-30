<?php

require_once __DIR__ . "/../model/Pesagem.php";
require_once __DIR__ . "/../model/Animal.php";

$pesagem = new Pesagem();
$animal = new Animal();

$animais = $animal->listar();

$dados = null;

if(isset($_GET["id"])){
    $dados = $pesagem->buscarPorId($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>

<?= isset($dados) ? "Editar Pesagem" : "Cadastrar Pesagem" ?>

</title>

<link rel="stylesheet" href="/rebanho/app/css/style.css">

</head>

<body>

<?php include __DIR__ . "/menu.php"; ?>

<div class="content">

<h1>

<?= isset($dados) ? "⚖️ Editar Pesagem" : "⚖️ Cadastrar Pesagem" ?>

</h1>

<div class="form-container">

<form method="POST" action="/rebanho/salvar_pesagem.php">

<?php if(isset($dados)){ ?>

<input
type="hidden"
name="id"
value="<?= $dados["id"] ?>">

<?php } ?>

<div class="form-group">

<label>Animal</label>

<select name="animal_id" required>

<?php foreach($animais as $a){ ?>

<option
value="<?= $a["id"] ?>"

<?= (isset($dados) && $dados["animal_id"] == $a["id"]) ? "selected" : "" ?>

>

<?= $a["nome"] ?> (Brinco <?= $a["numero_brinco"] ?>)

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Peso (kg)</label>

<input
type="number"
step="0.01"
name="peso"
value="<?= $dados["peso"] ?? '' ?>"
required>

</div>

<div class="form-group">

<label>Data da Pesagem</label>

<input
type="date"
name="data_pesagem"
value="<?= $dados["data_pesagem"] ?? date("Y-m-d") ?>"
required>

</div>

<div class="form-buttons">

<button class="btn" type="submit">

<?= isset($dados) ? "💾 Atualizar" : "💾 Salvar" ?>

</button>

<a href="pesagens.php" class="btn btn-voltar">

↩ Voltar

</a>

</div>

</form>

</div>

</div>

</body>

</html>