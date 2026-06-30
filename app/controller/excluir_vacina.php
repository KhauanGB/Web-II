<?php

require_once __DIR__ . "/../model/Vacina.php";

if(isset($_GET["id"])){

    $vacina = new Vacina();

    $vacina->excluir($_GET["id"]);

}

header("Location: ../view/vacinas.php");
exit();