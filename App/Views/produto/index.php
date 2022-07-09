<?php

use App\core\Funcoes;

$results = $data['results'];
$link = $data['link'];
$pesquisa = "";
if (isset($_SESSION['pesquisa'])) :
    $pesquisa = $_SESSION['pesquisa'];
endif;
$urlUpload = URL_BASE . '/Produto/upload/';
$urlVer = URL_BASE . '/Produto/ver/';
$urlIncluir = URL_BASE . '/Produto/incluir/';

if (isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") : ?>
    <script>
        swal({
            title: "<?= $_SESSION['title'] ?>",
            text: "<?= $_SESSION['mensagem'] ?>",
            icon: "<?= $_SESSION['icon'] ?>",
        });
    </script>
<?php
    Funcoes::apagarMessagem();
endif;

// outra opção de exibição de mensagem
if (isset($_SESSION['mensagem']) && $_SESSION['mensagem'] != "") :
    echo '<div class="alert alert-success" role="alert">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['resultado_operacao']);
endif;

?>


<h3>Produtos da Loja</h3>
<p></p>
<a href="<?= $urlIncluir ?>" class="btn btn-outline-primary">Novo</a>
<form action="<?= URL_BASE . '/Produto/pesquisar' ?>" method="POST">
    <div class="col-4 offset-md-8">
        <div class="input-group">
            <input type="text" class="form-control" value="<?= $pesquisa  ?>" name="pesquisa" placeholder="Pesquisa Produto">
            <div class="input-group-append">
                <button class="btn btn-secondary" type="submit">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
    </div>
</form>


<div class="col-12">
    <table class="table table-striped table-condensed table-bordered table-rounded">
        <thead>
            <tr>
                <th width="10%">Id
                    <?php
                    if (isset($_SESSION['orientacao']) && (!empty($_SESSION['orientacao']))) :
                        switch ($_SESSION['orientacao']) {
                            case 'ASC':
                                echo '<a class="float-right" href="' . URL_BASE . '/Produto/ordem/id/DESC' . '"><i class="fas fa-sort-numeric-up"></i></a>';
                                break;
                            case 'DESC':
                                echo '<a class="float-right" href="' . URL_BASE . '/Produto/ordem/id/ASC' . '"><i class="fas fa-sort-numeric-down"></i></a>';
                                break;
                        }
                    else :
                        echo  '<a class="float-right" href="' . URL_BASE . '/Produto/ordem/id/ASC' . '"><i class="fas fa-sort-alpha-down"></i></a>';
                    endif ?>


                </th>
                <th width="75%">Título

                    <?php
                    if (isset($_SESSION['orientacao']) && (!empty($_SESSION['orientacao']))) :
                        switch ($_SESSION['orientacao']) {
                            case 'ASC':
                                echo '<a class="float-right" href="' . URL_BASE . '/Produto/ordem/titulo/DESC' . '"><i class="fas fa-sort-alpha-up"></i></a>';
                                break;
                            case 'DESC':
                                echo '<a class="float-right" href="' . URL_BASE . '/Produto/ordem/titulo/ASC' . '"><i class="fas fa-sort-alpha-down"></i></a>';
                                break;
                        }
                    else :
                        echo  '<a class="float-right" href="' . URL_BASE . '/Produto/ordem/titulo/ASC' . '"><i class="fas fa-sort-alpha-down"></i></a>';
                    endif ?>
                </th>
                <th width="15%">Ações</th>
            </tr>
        </thead>
        <tbody>

            <?php for ($i = 0; $i < count($results->data); $i++) : ?>
                <tr>
                    <td><?= htmlentities(utf8_encode($results->data[$i]['id'])); ?></td>
                    <td><?= htmlentities(utf8_encode($results->data[$i]['titulo'])); ?></td>
                    <td>
                        <a href='<?= $urlUpload . $results->data[$i]['id']; ?>'>Upload</a> |
                        <a href='<?= $urlVer . $results->data[$i]['id']; ?>'>Ver</a>

                    </td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
    <?= $link ?>
</div>