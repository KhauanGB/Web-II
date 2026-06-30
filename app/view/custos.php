<?php

session_start();

if(!isset($_SESSION["usuario"])){

    header("Location: /rebanho/index.php");
    exit();

}

require_once __DIR__ . "/../model/Custo.php";

$custo = new Custo();

$lista = $custo->listar();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="UTF-8">

    <title>Controle de Custos</title>

    <link rel="stylesheet"
          href="/rebanho/app/css/style.css">

</head>

<body>

<?php include "menu.php"; ?>

<div class="content">

    <h2>💰 Controle de Custos</h2>

    <a href="custo_form.php" class="btn">
        ➕ Novo Custo
    </a>

    <br><br>

    <table>

        <tr>

            <th>ID</th>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Valor</th>
            <th>Data</th>
            <th>Animal</th>
            <th>Ações</th>

        </tr>

        <?php foreach($lista as $c){ ?>

        <tr>

            <td><?= $c["id"] ?></td>

            <td><?= $c["tipo"] ?></td>

            <td><?= $c["descricao"] ?></td>

            <td>
                R$ <?= number_format($c["valor"], 2, ",", ".") ?>
            </td>

            <td><?= $c["data"] ?></td>

            <td>
                <?= $c["nome_animal"] ?? "-" ?>
            </td>

            <td>

                <a href="custo_form.php?id=<?= $c['id'] ?>">
                    Editar
                </a>

                |

                <a href="../controller/excluir_custo.php?id=<?= $c['id'] ?>"
                   onclick="return confirm('Deseja realmente excluir este custo?')">

                    Excluir

                </a>

            </td>

        </tr>

        <?php } ?>

    </table>

</div>

</body>

</html>