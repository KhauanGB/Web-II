<?php

require_once __DIR__ . "/../model/Vacina.php";
require_once __DIR__ . "/../model/Animal.php";

$vacina = new Vacina();
$animal = new Animal();

$animais = $animal->listar();

$dados = null;

if(isset($_GET["id"])){
    $dados = $vacina->buscarPorId($_GET["id"]);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>

        <?= isset($dados) ? "Editar Vacina" : "Cadastrar Vacina" ?>

    </title>

    <link rel="stylesheet" href="/rebanho/app/css/style.css">

</head>

<body>

<?php include __DIR__ . "/menu.php"; ?>

<div class="content">

<h1>

<?= isset($dados) ? "💉 Editar Vacina" : "💉 Cadastrar Vacina" ?>

</h1>

<div class="form-container">

<form method="POST" action="/rebanho/salvar_vacina.php">

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
<?= (isset($dados) && $dados["animal_id"] == $a["id"]) ? "selected" : "" ?>>

<?= $a["nome"] ?> (Brinco <?= $a["numero_brinco"] ?>)

</option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label>Nome da Vacina</label>

<input
type="text"
name="nome_vacina"
value="<?= $dados["nome_vacina"] ?? '' ?>"
required>

</div>

<div class="form-group">

<label>Data da Vacinação</label>

<input
type="date"
name="data_vacina"
value="<?= $dados["data_vacina"] ?? '' ?>"
required>

</div>

<div class="form-group">

<label>Próxima Vacinação</label>

<input
type="date"
name="proxima_vacinacao"
value="<?= $dados["proxima_vacinacao"] ?? '' ?>">

</div>

<div class="form-group">

<label>Observação</label>

<textarea
name="observacao"
rows="4"><?= $dados["observacao"] ?? '' ?></textarea>

</div>

<div class="form-buttons">

<button class="btn" type="submit">

<?= isset($dados) ? "💾 Atualizar" : "💾 Salvar" ?>

</button>

<a href="vacinas.php" class="btn btn-voltar">

↩ Voltar

</a>

</div>

</form>

</div>

</div>

</body>

</html>