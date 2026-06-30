<?php

require_once __DIR__ . "/../model/Animal.php";

$animal = new Animal();

$dados = null;

if(isset($_GET["id"])){
    $dados = $animal->buscarPorId($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>

        <?= isset($dados) ? "Editar Animal" : "Cadastrar Animal" ?>

    </title>

    <link rel="stylesheet" href="/rebanho/app/css/style.css">

</head>

<body>

<?php include __DIR__ . "/menu.php"; ?>

<div class="content">

<h1>

<?= isset($dados) ? "✏️ Editar Animal" : "🐄 Cadastrar Animal" ?>

</h1>

<div class="form-container">

<form method="POST" action="/rebanho/salvar_animal.php">

<?php if(isset($dados)){ ?>

<input
type="hidden"
name="id"
value="<?= $dados["id"] ?>">

<?php } ?>

<div class="form-group">

<label>Número do Brinco</label>

<input
type="text"
name="numero_brinco"
value="<?= $dados["numero_brinco"] ?? '' ?>"
required>

</div>

<div class="form-group">

<label>Nome</label>

<input
type="text"
name="nome"
value="<?= $dados["nome"] ?? '' ?>">

</div>

<div class="form-group">

<label>Raça</label>

<input
type="text"
name="raca"
value="<?= $dados["raca"] ?? '' ?>">

</div>

<div class="form-group">

<label>Peso (kg)</label>

<input
type="number"
step="0.01"
name="peso"
value="<?= $dados["peso"] ?? '' ?>">

</div>

<div class="form-group">

<label>Sexo</label>

<select name="sexo">

<option value="Macho"
<?= (($dados["sexo"] ?? '') == "Macho") ? "selected" : "" ?>>
Macho
</option>

<option value="Fêmea"
<?= (($dados["sexo"] ?? '') == "Fêmea") ? "selected" : "" ?>>
Fêmea
</option>

</select>

</div>

<div class="form-group">

<label>Data de Nascimento</label>

<input
type="date"
name="data_nascimento"
value="<?= $dados["data_nascimento"] ?? '' ?>">

</div>

<div class="form-buttons">

<button type="submit" class="btn">

<?= isset($dados) ? "💾 Atualizar" : "💾 Salvar" ?>

</button>

<a href="animais.php" class="btn btn-voltar">

↩ Voltar

</a>

</div>

</form>

</div>

</div>

</body>

</html>