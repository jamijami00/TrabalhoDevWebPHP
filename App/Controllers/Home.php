<?php

namespace App\Controllers;

use App\Core\BaseController;

class Home extends BaseController
{

    function __construct()
    {
        session_start();
    }
    public function index()
    {
        // instanciar o model
        // $this->model método herdado de BaseController
        $artigoModel = $this->model("ArtigoModel");

        $artigos = $artigoModel->read()->fetchAll(\PDO::FETCH_ASSOC);

        $data = ['artigos' => $artigos];

        $this->view('home/index', $data);
    }
}
