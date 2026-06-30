<?php

require_once __DIR__ . "/../model/Custo.php";
require_once __DIR__ . "/../model/Animal.php";

$custo = new Custo();
$animal = new Animal();

$animais = $animal->listar();

$dados = null;

if(isset($_GET["id"])){
    $dados = $custo->buscarPorId($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>

        <?= isset($dados) ? "Editar Custo" : "Cadastrar Custo" ?>

    </title>

    <link rel="stylesheet" href="/rebanho/app/css/style.css">

</head>

<body>

<?php include __DIR__ . "/menu.php"; ?>

<div class="content">

<h1>

<?= isset($dados) ? "💰 Editar Custo" : "💰 Cadastrar Custo" ?>

</h1>

<div class="form-container">

<form method="POST" action="/rebanho/salvar_custo.php">

<?php if(isset($dados)){ ?>

<input
type="hidden"
name="id"
value="<?= $dados["id"] ?>">

<?php } ?>

<div class="form-group">

<label>Categoria do Custo</label>

<select name="tipo">

<option value="Ração"
<?= (($dados["tipo"] ?? "") == "Ração") ? "selected" : "" ?>>
Ração
</option>

<option value="Vacina"
<?= (($dados["tipo"] ?? "") == "Vacina") ? "selected" : "" ?>>
Vacina
</option>

<option value="Medicamento"
<?= (($dados["tipo"] ?? "") == "Medicamento") ? "selected" : "" ?>>
Medicamento
</option>

<option value="Transporte"
<?= (($dados["tipo"] ?? "") == "Transporte") ? "selected" : "" ?>>
Transporte
</option>

<option value="Manutenção"
<?= (($dados["tipo"] ?? "") == "Manutenção") ? "selected" : "" ?>>
Manutenção
</option>

<option value="Outros"
<?= (($dados["tipo"] ?? "") == "Outros") ? "selected" : "" ?>>
Outros
</option>

</select>

</div>

<div class="form-group">

<label>Descrição</label>

<input
type="text"
name="descricao"
value="<?= $dados["descricao"] ?? '' ?>"
required>

</div>

<div class="form-group">

<label>Valor (R$)</label>

<input
type="number"
step="0.01"
name="valor"
value="<?= $dados["valor"] ?? '' ?>"
required>

</div>

<div class="form-group">

<label>Data</label>

<input
type="date"
name="data"
value="<?= $dados["data"] ?? date("Y-m-d") ?>"
required>

</div>

<div class="form-group">

<label>Animal</label>

<select name="animal_id">

<?php foreach($animais as $a){ ?>

<option
value="<?= $a["id"] ?>"
<?= (isset($dados) && $dados["animal_id"] == $a["id"]) ? "selected" : "" ?>>

<?= $a["nome"] ?> (Brinco <?= $a["numero_brinco"] ?>)

</option>

<?php } ?>

</select>

</div>

<div class="form-buttons">

<button class="btn" type="submit">

<?= isset($dados) ? "💾 Atualizar" : "💾 Salvar" ?>

</button>

<a href="custos.php" class="btn btn-voltar">

↩ Voltar

</a>

</div>

</form>

</div>

</div>

</body>

</html>