<?php

namespace App\Controllers;

use App\Core\BaseController;

class Produto extends BaseController
{

    function __construct()
    {
        session_start();
    }
    public function index()
    {
        $produtoModel = $this->model("ProdutoModel");

        $produtos = $produtoModel->read()->fetchAll(\PDO::FETCH_ASSOC);

        $produtosValidos = array_filter($produtos, function($produto) {
            if ($produto['quantidade_disponível'] > 0){
                if($produto['liberado_venda'] == 'S'){
                    return $produto;
                }
            }
        });

        $data = ['produtos' => $produtosValidos];

        $this->view('produto/index', $data);
    }
}
