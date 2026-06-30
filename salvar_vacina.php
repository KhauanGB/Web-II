<?php
session_start();
include("conexao.php");

$animal_id = $_POST['animal_id'];
$nome_vacina = $_POST['nome_vacina'];
$data_vacina = $_POST['data_vacina'];
$proxima_vacinacao = $_POST['proxima_vacinacao'];
$observacao = $_POST['observacao'];

$sql = "INSERT INTO vacinas 
(animal_id, nome_vacina, data_vacina, proxima_vacinacao, observacao)

VALUES
('$animal_id',
 '$nome_vacina',
 '$data_vacina',
 '$proxima_vacinacao',
 '$observacao')";

mysqli_query($conn, $sql);

header("Location: vacinas.php");
?>