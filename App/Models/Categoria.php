<?php

namespace App\models;

class Categoria
{
    private $id, $nome_categoria;

    public function __construct()
    {
        $this->id = 0;
        $this->nome_categoria = "";
    }
}