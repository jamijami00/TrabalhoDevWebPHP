<?php

namespace App\models;

class Cliente
{
    private $id, $nome, $cpf, $endereco, $bairro, $cidade, $uf, $cep, $telefone, $email;

    public function __construct()
    {
        $this->id = 0;
        $this->nome = "";
        $this->cpf= "";
        $this->endereco = "";
        $this->cidade = "";
        $this->uf = "";
        $this->cep = "";
        $this->telefone = "";
        $this->email = "";
    }
}