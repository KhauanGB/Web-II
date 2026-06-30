<?php

require_once __DIR__ . "/../model/Animal.php";

if (isset($_GET["id"])) {

    $id = $_GET["id"];

    $animal = new Animal();

    $animal->excluir($id);

}

header("Location: ../view/animais.php");
exit();