<?php

session_start();

if(!isset($_SESSION["usuario"])){

    header("Location: /rebanho/index.php");
    exit();

}

require_once __DIR__ . "/../model/Vacina.php";

$vacina = new Vacina();

$lista = $vacina->listar();

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="UTF-8">

    <title>Vacinas</title>

    <link rel="stylesheet"
    href="/rebanho/app/css/style.css">

</head>

<body>

<?php include "menu.php"; ?>

<div class="content">

<h2>💉 Controle de Vacinas</h2>

<a href="vacina_form.php" class="btn">
    Cadastrar Nova Vacina
</a>

<br><br>

<table border="1">

<tr>

<th>ID</th>
<th>Animal</th>
<th>Vacina</th>
<th>Data Aplicação</th>
<th>Próxima Vacinação</th>
<th>Status</th>
<th>Observação</th>
<th>Ações</th>

</tr>

<?php foreach($lista as $v) { ?>

<tr>

<td><?= $v["id"] ?></td>

<td><?= $v["nome_animal"] ?></td>

<td><?= $v["nome_vacina"] ?></td>

<td><?= $v["data_vacina"] ?></td>

<td><?= $v["proxima_vacinacao"] ?></td>

<td>

<?php

if(strtotime($v["proxima_vacinacao"]) < time()){

    echo "🔴 Vencida";

}else{

    echo "🟢 Em Dia";

}

?>

</td>

<td><?= $v["observacao"] ?></td>

<td>

<a href="vacina_form.php?id=<?= $v['id'] ?>">
Editar
</a>

|

<a href="../controller/excluir_vacina.php?id=<?= $v['id'] ?>"
onclick="return confirm('Deseja excluir esta vacina?')">

Excluir

</a>

</td>

</tr>

<?php } ?>

</table>

</div>

</body>

</html>