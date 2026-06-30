<?php

class Cotacao
{

    public function arrobaHoje()
    {

        $json = file_get_contents(
            "https://agrodocai.com.br/api/v1/cotacao"
        );

        $dados = json_decode($json, true);

        return $dados["boi_gordo_cepea_sp"];

    }

}