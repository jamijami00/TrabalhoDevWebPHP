
<h3>Dados do Produto</h3>
<?php
// listando os dados do produto
$imagem = $data['imagem'];
$produto = $data['produto'];
if (!empty($imagem)) :
?>
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?= $imagem ?>" alt="Card image cap">
        <div class="card-body">

            <h5 class="card-title"><?= htmlentities(utf8_encode($artigo['titulo'])) ?></h5>
            <p class="card-text"><?= htmlentities(utf8_encode($artigo['conteudo'])) ?></p>
        </div>
    </div>

<?php else : ?>

    <p></p>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlentities(utf8_encode($artigo['titulo'])) ?></h5>
            <p class="card-text"><?= htmlentities(utf8_encode($artigo['conteudo'])) ?></p>
        </div>
    </div>
<?php endif ?>
<p></p>
<a class="btn btn-danger" href="<?= URL_BASE . '/Artigo' ?>">Cancelar</a>