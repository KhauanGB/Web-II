<?php

require_once __DIR__ . "/../model/Animal.php";

class AnimalController {

    public function salvar() {

        if ($_POST) {

            $animal = new Animal();

            $id = $_POST["id"] ?? null;

            $numero_brinco = $_POST["numero_brinco"];
            $nome = $_POST["nome"];
            $raca = $_POST["raca"];
            $peso = $_POST["peso"];
            $sexo = $_POST["sexo"];
            $data_nascimento = $_POST["data_nascimento"];

            if ($id) {

                // EDITAR
                $animal->atualizar(
                    $id,
                    $numero_brinco,
                    $nome,
                    $raca,
                    $peso,
                    $sexo,
                    $data_nascimento
                );

            } else {

                // CADASTRAR
                $animal->salvar(
                    $numero_brinco,
                    $nome,
                    $raca,
                    $peso,
                    $sexo,
                    $data_nascimento
                );

            }

            header("Location: app/view/animais.php");
            exit();

        }

    }

}

?>