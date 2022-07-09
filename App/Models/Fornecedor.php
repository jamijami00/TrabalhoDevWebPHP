<?php

namespace App\models;

class Fornecedor
{
    private $id, $razao_social, $cnpj, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $email;

    public function __construct()
    {
        $this->id = 0;
        $this->razao_social = "";
        $this->cnpj= "";
        $this->endereco = "";
        $this->bairro = "";
        $this->cidade = "";
        $this->uf = "";
        $this->cep = "";
        $this->telefone = "";
        $this->email = "";
    }
}