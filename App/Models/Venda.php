<?php

namespace App\models;

class Venda
{
    private $id, $quantidade_venda, $data_venda, $valor_venda, $id_cliente, $id_produto, $id_funcionario;

    public function __construct()
    {
        $this->id = 0;
        $this->quantidade_venda = 0;
        $this->data_venda= "";
        $this->valor_venda = 0.00;
        $this->id_cliente = 0;
        $this->id_produto = 0;
        $this->id_funcionario = 0;
    }
}