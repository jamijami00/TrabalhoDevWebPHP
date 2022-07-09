<?php

namespace App\models;

class Produto
{
    private $id, $nome_produto, $descricao, $preco_compra, $preco_venda, 
    $quantidade_disponivel, $liberado_venda, $id_categoria;

    public function __construct()
    {
        $this->id = 0;
        $this->nome_produto = "";
        $this->descricao = "";
        $this->preco_compra = 0.00;
        $this->preco_venda = 0.00;
        $this->quantidade_disponivel = 0;
        $this->liberado_venda = "";
        $this->id_categoria = 0;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getNomeProduto()
    {
        return $this->nome_produto;
    }

    public function setNomeProduto($nome_produto)
    {
        $this->nome_produto = $nome_produto;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }

    public function getPrecoCompra()
    {
        return $this->preco_compra;
    }

    public function setPrecoCompra($preco_compra)
    {
        $this->preco_compra = $preco_compra;
    }

    public function getPrecoVenda()
    {
        return $this->preco_venda;
    }

    public function setPrecoVenda($preco_venda)
    {
        $this->preco_venda = $preco_venda;
    }

    public function getQuantidadeDisponivel()
    {
        return $this->quantidade_disponivel;
    }

    public function setQuantidadeDisponivel($quantidade_disponivel)
    {
        $this->quantidade_disponivel = $quantidade_disponivel;
    }

    public function getLiberdadoVenda()
    {
        return $this->liberado_venda;
    }

    public function setLiberadoVenda($liberado_venda)
    {
        $this->liberado_venda = $liberado_venda;
    }

    public function getIdCategoria()
    {
        return $this->id_categoria;
    }

    public function setIdCategoria($id_categoria)
    {
        $this->id_categoria = $id_categoria;
    }
}