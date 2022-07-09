<?php

namespace App\Controllers;

use App\Core\BaseController;
use App\core\Funcoes;
use App\Core\Paginacao;
use GUMP as Validador;

class Artigo extends BaseController
{
    protected $filters = [
        'titulo' => 'trim|sanitize_string',
        'conteudo' => 'trim|sanitize_string'
    ];

    protected $rules = [
        'titulo'    => 'required|min_len,2|max_len,40',
        'conteudo'    => 'required|min_len,2|max_len,40'
    ];

    function __construct()
    {
        session_start();
        if (!Funcoes::usuarioLogado()) :
            Funcoes::redirect("Home");
        endif;
    }

    public function index($numPag = 1)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            // validação da URL
            if (filter_var($numPag, FILTER_VALIDATE_INT)) :
                $numPag = $numPag;
            else :
                $numPag = 1;
            endif;

            // atribui o default para ordenação
            if (!isset($_SESSION['campo_ordem'])) :
                $_SESSION['campo_ordem'] = 'titulo';
            endif;

            if (!isset($_SESSION['orientacao'])) :
                $_SESSION['orientacao'] = 'ASC';
            endif;

            if (!isset($_SESSION['pesquisa'])) :
                $_SESSION['pesquisa'] = '';
            endif;

            $query = "SELECT id,titulo FROM artigos ";

            $artigoModel = $this->model("ArtigoModel");

            $paginacao = new Paginacao($artigoModel, $query, $_SESSION['campo_ordem'], $_SESSION['orientacao'], $_SESSION['pesquisa']);

            $results = $paginacao->getData($numPag);

            $link = $paginacao->createLinks('Artigo/index');

            $data = ['results' => $results, 'link' => $link];

            $this->view('artigo/index', $data);

        else :
            Funcoes::redirect("Home");
        endif;
    }


    public function ordem($campo_ordem = 'id', $orientacao = "ASC")
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :

            $campo_ordem = filter_var($campo_ordem, FILTER_SANITIZE_STRING);
            $orientacao = filter_var($orientacao, FILTER_SANITIZE_STRING);

            $campos = ['titulo', 'id'];
            $opcao_oientacao = ['ASC', 'DESC'];

            $_SESSION['campo_ordem'] = 'id';
            if (in_array($campo_ordem, $campos)) :
                $_SESSION['campo_ordem'] = $campo_ordem;
            endif;

            $_SESSION['orientacao'] = 'ASC';
            if (in_array($orientacao, $opcao_oientacao)) :
                $_SESSION['orientacao'] = $orientacao;
            endif;

            $this->index(1);

        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function pesquisar()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :
            $pesquisa = filter_var($_POST['pesquisa'], FILTER_SANITIZE_STRING);
            $_SESSION['pesquisa'] = $pesquisa;
            Funcoes::redirect("Artigo");
        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function upload($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            if (!filter_var($id, FILTER_VALIDATE_INT)) :
                die("Erro 404");
            else :
                $data = ['id' => $id];
                $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
                $this->viewUpload('artigo/upload', $data);
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function enviarImagem()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                if (!filter_var($_POST['id'], FILTER_VALIDATE_INT)) :
                    die("Erro 404");
                endif;

                if (!isset($_FILES["arquivoimagem"])) :
                    $data = ["erros" => 'Selecione o arquivo'];
                    // novo método no BaseController
                    // por causa do <script>
                    $this->viewUpload('artigo/upload', $data);
                else :

                    // definição do local de armazenamento
                    $storage = new \Upload\Storage\FileSystem('upload');
                    // o arquivo de imagem enviado
                    $file = new \Upload\File('arquivoimagem', $storage);

                    // Optionally you can rename the file on upload
                    //$new_filename = uniqid();
                    //$file->setName($new_filename);

                    $file->setName($_POST['id']);

                    // Validate file upload
                    // MimeType List => http://www.iana.org/assignments/media-types/media-types.xhtml
                    $file->addValidations(array(
                        // Ensure file is of type "image/png"
                        new \Upload\Validation\Mimetype('image/png'),

                        //You can also add multi mimetype validation
                        //new \Upload\Validation\Mimetype(array('image/png', 'image/gif'))

                        // Ensure file is no larger than 5M (use "B", "K", M", or "G")
                        new \Upload\Validation\Size('5M')
                    ));

                    // Try to upload file
                    try {
                        // Success!
                        $file->upload();
                        Funcoes::redirect("Artigo");
                    } catch (\Exception $e) {
                        // Fail!
                        $errors = $file->getErrors();
                        $erros = implode("<br>", $errors);

                        $data = ["erros" => $erros];
                        $this->viewUpload('artigo/upload', $data);
                    }

                endif;
            else :
                Funcoes::redirect("Home");
            endif;
        else :
            Funcoes::redirect("Home");
        endif;
    }


    public function ver($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            if (!filter_var($id, FILTER_VALIDATE_INT)) :
                die("Erro 404");
            else :

                $artigoModel = $this->model("ArtigoModel");
                $artigo = $artigoModel->get($id);

                $diretorio = DIR_IMG_UPLOAD . $id . ".png";
                $url_imagem = URL_IMG_UPLOAD . $id . ".png";
               
               if (file_exists($diretorio)) : 
                    $imagem = $url_imagem;
                else :
                    $imagem = '';
                endif;

                $data = ['artigo' => $artigo, 'imagem' => $imagem];
                $this->view('artigo/ver', $data);
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function incluir()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') :
            // gera o CSRF_token e guarda na sessão
            $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
            $this->view('artigo/incluir');
        else :
            Funcoes::redirect("Home");
        endif;
    }

    public function gravarInclusao()
    {
        // trata a as solicitações POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') :

            // incluir usuário
            if ($_POST['CSRF_token'] == $_SESSION['CSRF_token']) :

                $validacao = new Validador("pt-br");

                $post_filtrado = $validacao->filter($_POST, $this->filters);
                $post_validado = $validacao->validate($post_filtrado, $this->rules);

                if ($post_validado === true) :  // verificar dados do artigo
                    
                    // criando um objeto artigo
                    $artigo = new \App\models\Artigo();
                    $artigo->setTitulo($_POST['titulo']);
                    $artigo->setConteudo($_POST['conteudo']);
                   
                    $artigoModel = $this->model("ArtigoModel");

                    $artigoModel->create($artigo);

                    Funcoes::setMessagem("Inclusão Realizada Com Sucesso");

                    Funcoes::redirect("Artigo");
                else :
                    $erros = $validacao->get_errors_array();
                    $_SESSION['CSRF_token'] = Funcoes::gerarTokenCSRF();
                    $data = ['erros' => $erros];
                    $this->view('Artigo/incluir', $data);
                endif;
            else :
                die("Erro 404");
            endif;

        else :
            Funcoes::redirect("Home");
        endif;
    }
}
