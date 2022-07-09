<?php

namespace App\models;

class Compra
{
    private $id, $quantidade_compra, $data_compra, $valor_compra, $id_fornecedor, $id_produto, $id_funcionario;

    public function __construct()
    {
        $this->id = 0;
        $this->quantidade_compra = "";
        $this->data_compra= "";
        $this->valor_compra = "";
        $this->id_fornecedor = 0;
        $this->id_funcionario = 0;
        $this->id_produto = 0;
    }
}