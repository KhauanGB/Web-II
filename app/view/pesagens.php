<?php

session_start();

if(!isset($_SESSION["usuario"])){

    header("Location: /rebanho/index.php");
    exit();

}

require_once __DIR__ . "/../model/Pesagem.php";

$pesagem = new Pesagem();

$lista = $pesagem->listar();

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Pesagens</title>

    <link rel="stylesheet"
    href="/rebanho/app/css/style.css">

</head>

<body>

<?php include "menu.php"; ?>

<div class="content">

<h2>⚖️ Controle de Pesagens</h2>

<a href="pesagem_form.php" class="btn">>
    Registrar Nova Pesagem
</a>

<br><br>

<table>

<tr>

<th>ID</th>
<th>Animal</th>
<th>Peso (kg)</th>
<th>Data da Pesagem</th>
<th>Ações</th>

</tr>

<?php foreach($lista as $p) { ?>

<tr>

<td><?= $p["id"] ?></td>

<td><?= $p["nome_animal"] ?></td>

<td><?= number_format($p["peso"], 2, ',', '.') ?></td>

<td><?= $p["data_pesagem"] ?></td>

<td>

<a href="pesagem_form.php?id=<?= $p['id'] ?>" class="btn">
Editar
</a>

|

<a href="../controller/excluir_pesagem.php?id=<?= $p['id'] ?>"
onclick="return confirm('Deseja excluir esta pesagem?')" class="btn">

Excluir

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>