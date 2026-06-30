<?php

require_once __DIR__ . "/../model/Pesagem.php";

if(isset($_GET["id"])){

    $pesagem = new Pesagem();

    $pesagem->excluir($_GET["id"]);

}

header("Location: ../view/pesagens.php");
exit();