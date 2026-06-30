<?php

require_once __DIR__ . "/../model/Pesagem.php";

class PesagemController {

    public function salvar(){

        if($_POST){

            $pesagem = new Pesagem();

            $id = $_POST["id"] ?? null;

            if($id){

                $pesagem->atualizar(
                    $id,
                    $_POST["animal_id"],
                    $_POST["peso"],
                    $_POST["data_pesagem"]
                );

            }else{

                $pesagem->salvar(
                    $_POST["animal_id"],
                    $_POST["peso"],
                    $_POST["data_pesagem"]
                );

            }

            header("Location: /rebanho/app/view/pesagens.php");
            exit();

        }

    }

}