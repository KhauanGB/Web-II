<?php

require_once __DIR__ . "/../model/Custo.php";

if(isset($_GET["id"])){

    $custo = new Custo();

    $custo->excluir($_GET["id"]);

}

header("Location: ../view/custos.php");
exit();