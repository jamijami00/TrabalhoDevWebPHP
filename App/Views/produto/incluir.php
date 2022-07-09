<h3>Incluir Produto</h3>
<?php

if (isset($data['erros']) && (!empty($data['erros']))) : ?>
    <div class="alert alert-danger" role="alert">
        <?php
        foreach ($data['erros'] as $erro) {
            echo $erro . "<br>";
        }
        ?>
    </div>
<?php endif ?>
<form action="<?= URL_BASE . '/Produto/gravarInclusao' ?>" method="POST">
    <input type="hidden" id="token_csrf" name="CSRF_token" value="<?= $_SESSION['CSRF_token'] ?>" />
    <div class="form-group">
        <label for="titulo">Nome*</label>
        <input required type="text" class="form-control" id="titulo" name="titulo">
    </div>
    <div class="form-group">
        <label for="conteudo">Descrição*</label>
        <input required type="text" class="form-control" id="conteudo" name="conteudo">
    </div>
    <button type="submit" name="bt_acao" value="incluir" class="btn btn-primary">Incluir</button>
    <a href="<?= URL_BASE . '/Artigo/index' ?>" class="btn btn-outline-danger">Cancelar</a>
</form>