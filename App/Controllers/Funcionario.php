<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\core\Funcoes;
use GUMP as Validador;

class Funcionario extends BaseController
{

    protected $filters = [
        'nome' => 'trim|sanitize_string|upper_case',
        'cpf' => 'trim|sanitize_string|upper_case',
        'senha' => 'trim|sanitize_string|lower_case',
        'papel' => 'trim|sanitize_string|lower_case'
    ];

    protected $rules = [
        'nome' => 'required|min_len,2|max_len,40',
        'cpf' => 'required|min_len,14|max_len,14',
        'senha' => 'required|min_len,3',
        'papel' => 'required|min_len,1|max_len,1',
    ];

    function __construct()
    {
        session_start();
        if (!Funcoes::funcionarioLogado()) :
            Funcoes::redirect("Home");
        endif;
    }

    public function index($numPag = 1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

            $funcionarioModel = $this->model("FuncionarioModel");

            $funcionario = $funcionarioModel->read()->fetchAll(\PDO::FETCH_ASSOC);
    
            $data = ['funcionarios' => $funcionario];
            $data['token'] = $_SESSION['CSRF_token'];
            echo '<input type="hidden"></input>';
            $this->view('funcionario/index', $data, 'funcionario/funcionariojs');
        else :
            Funcoes::redirect("Home");
        endif;
    }


    public function ajax_lista($data)
    {

        $numPag = $data['numPag'];

        // calcula o offset
        $offset = ($numPag - 1) * REGISTROS_PAG;

        $funcionarioModel = $this->model("FuncionarioModel");

        // obtém a quantidade total de registros na base de dados
        $total_registros = $funcionarioModel->getTotalFuncionarios();

        // calcula a quantidade de páginas - ceil — Arredonda frações para cima
        $total_paginas = ceil($total_registros / REGISTROS_PAG);

        // obtém os registros referente a página
        $lista_funcionarios = $funcionarioModel->getRegistroPagina($offset, REGISTROS_PAG)->fetchAll(\PDO::FETCH_ASSOC);

        $corpoTabela = "";

        if (!empty($lista_funcionarios)) :
            foreach ($lista_funcionarios as $funcionario) {
                $corpoTabela .= "<tr>";
                $corpoTabela .= "<td>" . htmlentities(utf8_encode($funcionario['id'])) . "</td>";
                $corpoTabela .= "<td>" . htmlentities($funcionario['nome'], ENT_QUOTES, 'UTF-8') . "</td>";
                $corpoTabela .= "<td>" . htmlentities($funcionario['cpf'], ENT_QUOTES, 'UTF-8') . "</td>";
                $corpoTabela .= "<td>" . htmlentities($funcionario['papel'], ENT_QUOTES, 'UTF-8') . "</td>";
                $corpoTabela .= "<td>" . '<button type="button" id="btAlterar" data-id="' . $funcionario['id'] . '" class="btn btn-outline-primary">Alterar</button>
                                          <button type="button" id="btExcluir" data-id="' . $funcionario['id'] . '" data-nome="' . $funcionario['nome'] . '"class="btn btn-outline-primary">Excluir</button>'
                    . "</td>";
                $corpoTabela .= "</tr>";
            }

            $links = '<nav aria-label="Page navigation example">';
            $links .= '<ul class="pagination">';

            for ($page = 1; $page <= $total_paginas; $page++) {
                $links .= '<li class="page-item"><a class="page-link link-navegacao" href="javascript:load_data(' . $page . ')">' . $page . '</a></li>';
            }
            $links .= '  </ul></nav>';

        else :
            $corpoTabela = "<tr>Não há funcionarios</tr>";
        endif;

        $data = [];
        $data["TotalRegistros"] = $total_registros;
        $data["TotalPaginas"] = $total_paginas;
        $data["corpoTabela"] = $corpoTabela;
        $data["links"] = $links;
        $data['status'] = true;
        echo json_encode($data);
        exit();
    }

    // ***********************************************************************
    // chama a view para entrada dos dados da funcionario
    public function incluir()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
            // devolve os dados 
            $data = array();
            $data['token'] = $_SESSION['CSRF_token'];
            $data['status'] = true;
            echo json_encode($data);
            exit();
        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function gravarInclusao()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $validacao = new Validador("pt-br");
                $post_filtrado = $validacao->filter($_POST, $this->filters);
                $post_validado = $validacao->validate($post_filtrado, $this->rules);

                if ($post_validado === true) :  // verificar dados do usuario

                    //$hash_senha = password_hash($_POST['senha'], PASSWORD_ARGON2I); // gerar hash senha enviada

                    $funcionario = new \App\models\Funcionario(); // criar uma instância de usuário
                    $funcionario->setNome($_POST['nome']);   // setar os valores
                    $funcionario->setCpf($_POST['cpf']);
                    $funcionario->setSenha($_POST['senha']);
                    $funcionario->setPapel($_POST['papel']);
                    $funcionarioModel = $this->model("FuncionarioModel"); 
                    $funcionarioModel->create($funcionario); // incluir usuário no BD
                    
                    //$hashId = hash('sha512', $chaveGerada);  // calcular o hash da id (chave primária) gerada
                    //$userModel->createHashID($chaveGerada, $hashId);

                    $data['status'] = true;          // retornar inclusão realizada
                    echo json_encode($data);
                    exit();
                else :  // validação dos dados falhou
                    $erros = $validacao->get_errors_array();  // obter erros de validação
                    $erros = implode("<br>", $erros);         // gerar uma string com os erros
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                    $data['token'] = $_SESSION['CSRF_token'];  // gerar CSRF
                    $data['status'] = false;        // retornar erros
                    $data['erros'] = $erros;
                    echo json_encode($data);
                    exit();
                endif;
            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

    // ***********************************************************************
    public function alterarFuncionario($data)
    {

       
    }

    public function gravarAlterar()
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') :
            parse_str(file_get_contents('php://input'), $_PUT);

            if ($_PUT['CSRF_token'] == $_SESSION['CSRF_token']) :

                $filters = [
                    'nome_alteracao' => 'trim|sanitize_string|upper_case',
                    'cpf_alteracao' => 'trim|sanitize_string|upper_case',
                    'senha_alteracao' => 'trim|sanitize_string|lower_case',
                    'papel_alteracao' => 'trim|sanitize_string|lower_case'
                ];

                $rules = [
                    'nome_alteracao' => 'required|min_len,2|max_len,40',
                    'cpf_alteracao' => 'required|min_len,14|max_len,14',
                    'senha_alteracao' => 'required|min_len,3',
                    'papel_alteracao' => 'required|min_len,1|max_len,1',
                ];

                $validacao = new Validador("pt-br");

                $put_filtrado = $validacao->filter($_PUT, $filters);
                $put_validado = $validacao->validate($put_filtrado, $rules);

                if ($put_validado === true) :  // verificar dados da funcionario

                    // criando um objeto funcionario
                    $funcionario = new \App\models\Funcionario();
                    $funcionario->setId($_PUT['id_alteracao']);
                    $funcionario->setNome($_PUT['nome_alteracao']);
                    $funcionario->setCpf($_POST['cpf_alteracao']);
                    $funcionario->setSenha($_POST['senha_alteracao']);
                    $funcionario->setPapel($_POST['papel_alteracao']);

                    $funcionarioModel = $this->model("FuncionarioModel");

                    $funcionarioModel->update($funcionario);

                    $data['status'] = true;
                    echo json_encode($data);
                    exit();


                else :
                    $erros = $validacao->get_errors_array();
                    $erros = implode("<br>", $erros);
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();

                    $funcionarioModel = $this->model("FuncionarioModel");
                    $funcionario = $funcionarioModel->get($_POST['id_alteracao']);

                    $data['status'] = true;
                    $data['nome'] = $funcionario['nome'];
                    $data['id'] =  $_POST['id_alteracao'];
                    $data['token'] = $_SESSION['CSRF_token'];
                    $data['status'] = false;
                    $data['erros'] = $erros;
                    echo json_encode($data);
                    exit();
                endif;
            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

    // ***********************************************************************


    public function excluirFuncionario($data)
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') :

            $id = $data['id'];

            $funcionarioModel = $this->model("FuncionarioModel");

            $funcionarioModel->delete($id);

            $data = array();
            $data['status'] = true;
            echo json_encode($data);
            exit();

        else :
            Funcoes::redirect("Home");
        endif;
    }
}
