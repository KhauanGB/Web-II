<?php

session_start();

if(!isset($_SESSION["usuario"])){

    header("Location: /rebanho/index.php");
    exit();

}

require_once __DIR__ . "/../model/Animal.php";

$animal = new Animal();

if (isset($_GET["busca"]) && $_GET["busca"] != "") {

    $lista = $animal->buscarPorBrinco($_GET["busca"]);

} else {

    $lista = $animal->listar();

}

?>

<link rel="stylesheet" href="/rebanho/app/css/style.css">

<?php include __DIR__ . "/menu.php"; ?>

<div class="content">


<a href="/rebanho/dashboard.php" class="btn">>
Voltar ao Dashboard
</a>

<br>

<h2>Lista de Animais</h2>

<br><br>

<form method="GET">

Buscar Brinco:

<input type="text"
name="busca"
placeholder="Digite o número">

<button type="submit" class="btn">>
Buscar
</button>

<a href="animais.php" class="btn">
Mostrar Todos
</a>

</form>

<br>


<a href="animal_form.php" class="btn">>
Cadastrar Novo Animal
</a>

<br><br>

<table border="1">

<tr>
<th>ID</th>
<th>Brinco</th>
<th>Nome</th>
<th>Raça</th>
<th>Peso (kg)</th>
<th>Sexo</th>
<th>Nascimento</th>
<th>Idade</th>
<th>Ações</th>
</tr>

<?php foreach($lista as $row) { ?>

<tr>

<td><?php echo $row["id"]; ?></td>
<td><?php echo $row["numero_brinco"]; ?></td>
<td><?php echo $row["nome"]; ?></td>
<td><?php echo $row["raca"]; ?></td>
<td><?php echo $row["peso"]; ?></td>
<td><?php echo $row["sexo"]; ?></td>
<?php
$data = new DateTime($row["data_nascimento"]);
$hoje = new DateTime();
$idade = $hoje->diff($data);
?>

<td><?= $row["data_nascimento"]; ?></td>
<td><?= $idade->y ?> ano(s)</td>

<td>

<a href="animal_form.php?id=<?= $row['id'] ?>">
Editar
</a>

|

<a href="../controller/excluir_animal.php?id=<?= $row['id'] ?>"
onclick="return confirm('Deseja realmente excluir este animal?')">
Excluir
</a>

</td>

</tr>
</div> 
<?php } ?>

</table>