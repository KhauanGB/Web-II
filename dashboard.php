<?php

session_start();

if (!isset($_SESSION["usuario"])) {
    header("Location: index.php");
    exit();
}

require_once __DIR__ . "/app/model/Animal.php";
require_once __DIR__ . "/app/model/Vacina.php";
require_once __DIR__ . "/app/model/Custo.php";
require_once __DIR__."/app/model/Cotacao.php";

$animal = new Animal();
$vacina = new Vacina();
$custo = new Custo();
$cotacao = new Cotacao();

/* ===========================
   DASHBOARD
=========================== */

$dados = $animal->dashboard();

$pesoTotal = $animal->pesoTotal();

$totalArrobas = $pesoTotal / 15;

$totalCustos = $custo->totalCustos();

$custoArroba = 0;

$valorArroba = $cotacao->arrobaHoje();

$valorRebanho = $totalArrobas * $valorArroba;

if($totalArrobas > 0){
    $custoArroba = $totalCustos / $totalArrobas;
}

/* ===========================
   VACINAS
=========================== */

$totalVacinas = $vacina->totalVacinas();

$totalProximas = $vacina->totalProximas();

$totalVencidas = $vacina->totalVencidas();

$proximasVacinas = $vacina->proximasVacinas();

/* ===========================
   GRÁFICO CUSTOS
=========================== */

$categorias = $custo->custosPorCategoria();

$labels = [];
$valores = [];

foreach($categorias as $categoria){

    $labels[] = $categoria["tipo"];
    $valores[] = $categoria["total"];

}

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>

<meta charset="UTF-8">

<title>Dashboard</title>

<link rel="stylesheet" href="/rebanho/app/css/style.css">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

<?php include __DIR__ . "/app/view/menu.php"; ?>

<div class="content">

<h1>Bem-vindo, <?= $_SESSION["usuario"] ?></h1>

<div class="cards">

<div class="card">
<h3>🐄 Total de Animais</h3>
<h2><?= $dados["total"] ?></h2>
</div>

<div class="card">
<h3>🐂 Machos</h3>
<h2><?= $dados["machos"] ?></h2>
</div>

<div class="card">
<h3>🐄 Fêmeas</h3>
<h2><?= $dados["femeas"] ?></h2>
</div>

<div class="card">
<h3>⚖ Peso Médio</h3>
<h2><?= number_format($dados["peso_medio"],2,",",".") ?> kg</h2>
</div>

<div class="card">
<h3>💰 Custo por Arroba</h3>
<h2>R$ <?= number_format($custoArroba,2,",",".") ?>/@</h2>
</div>

<div class="card">
    <h3>🐂 Arroba Hoje</h3>
    <h2>R$ <?= number_format($valorArroba,2,",",".") ?></h2>
</div>

<div class="card">

    <h3>💰 Valor Estimado do Rebanho</h3>
    <h2>R$<?= number_format($valorRebanho,2,",",".") ?></h2>
</div>

<div class="card">
<h3>💉 Vacinas</h3>
<h2><?= $totalVacinas ?></h2>
</div>

<div class="card">
<h3>📅 Próximas Vacinas</h3>
<h2><?= $totalProximas ?></h2>
</div>

<div class="card">
<h3>⚠ Vacinas Vencidas</h3>
<h2><?= $totalVencidas ?></h2>
</div>

</div>

<br>

<div class="card-grafico">

<h2>💰 Custos por Categoria</h2>

<canvas id="graficoCustos"></canvas>

</div>

<br>

<div class="alerta">

<h2>📅 Próximas Vacinações</h2>

<table>

<tr>

<th>Animal</th>
<th>Vacina</th>
<th>Próxima Vacinação</th>

</tr>

<?php foreach($proximasVacinas as $v){ ?>

<tr>

<td><?= $v["animal"] ?></td>

<td><?= $v["nome_vacina"] ?></td>

<td><?= $v["proxima_vacinacao"] ?></td>

</tr>

<?php } ?>

</table>

</div>

</div>

<script>

const ctx = document.getElementById('graficoCustos');

new Chart(ctx, {

    type: 'bar',

    data: {

        labels: <?= json_encode($labels) ?>,

        datasets: [{

            label: 'Valor (R$)',

            data: <?= json_encode($valores) ?>,

            backgroundColor: [

                '#4CAF50',
                '#2196F3',
                '#FF9800',
                '#E91E63',
                '#9C27B0',
                '#795548'

            ],

            borderRadius:8

        }]

    },

    options:{

        responsive:true,

        plugins:{

            legend:{
                display:false
            }

        },

        scales:{

            y:{

                beginAtZero:true

            }

        }

    }

});

</script>

</body>

</html>