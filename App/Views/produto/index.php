<?php
// listando os artigos
$produtos = $data['produtos'];
if (!empty($produtos)) :
    foreach ($produtos as $produto) { ?>
        <p></p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= $produto['nome_produto'] ?></h5>
                <h4 class="card-title"> R$ <?= number_format($produto['preco_venda'],2,",",".") ?></h4>
                <p class="card-text"><?= $produto['descricao'] ?></p>
            </div>
        </div>
<?php    }
else :
    echo "Não há produtos";
endif;
?>