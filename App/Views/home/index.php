<?php
// listando os artigos
$produtos = $data['produtos'];
if (!empty($produtos)) :
    foreach ($produtos as $produto) { ?>
        <p></p>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?= htmlentities(utf8_encode($produto['nome']))?></h5>
                <p class="card-text"><?= htmlentities(utf8_encode($produto['descricao']))?></p>
            </div>
        </div>
<?php    }
else :
    echo "Não há produtos";
endif;
?>