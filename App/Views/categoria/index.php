<!-- Button trigger modal -->
<button type="button" id="btIncluir" class="btn btn-outline-primary mb-1">
    Novo
</button>
<input type="hidden" id="CSRF_token" name="CSRF_token" value="" data-token = "<?= $data['token'] ?>"/>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody name="contudoTabela" id="contudoTabela">
    <?php
        $categorias = $data['categorias'];
        if (!empty($categorias)) :
            foreach ($categorias as $categoria) { 
                ?>
                <tr>
                    <td> <?= $categoria['id'] ?> </td>
                    <td> <?= $categoria['nome_categoria'] ?> </td>
                    <td>
                        <button type="button" id="btAlterar" class="btn btn-outline-primary" data-id="<?= $categoria['id'] ?>" data-nome="<?= $categoria['nome_categoria'] ?>">
                            Alterar
                        </button>
                        <button type="button" id="btExcluir" class="btn btn-outline-danger" data-id="<?= $categoria['id'] ?>">
                            Excluir
                        </button>
                    </td>
                </tr>
            <?php }
        else :
            echo "Não há categorias";
        endif;
    ?>
    </tbody>
</table>

<div id="pagination_link"></div>


<!-- Modal Inclusão da categoria-->
<div class="modal fade" id="modalNovaCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nova Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('categoria') ?>" id="formInclusao" method="POST">
                    <div id="mensagem_erro" name="mensagem_erro"></div>
                    <input type="hidden" id="CSRF_token" name="CSRF_token" value="" />
                    <div class="form-group">
                        <label for="nome_categoria">Nome da Categoria*</label>
                        <input type="text" class="form-control" id="nome_categoria" name="nome_categoria">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btSalvarInclusao" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal alteracao da categoria-->
<div class="modal fade" id="modalAlterarCategoria" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= url ('gravaralteracao') ?>" id="formAltercao" method="PUT">

                    <div id="mensagem_erro_alteracao" name="mensagem_erro_alteracao"></div>

                    <input type="hidden" id="CSRF_token" name="CSRF_token" value="" />
                    <input type="hidden" id="id_alteracao" name="id_alteracao" value="PUT" />

                    <div class="form-group">
                        <label for="nome_categoria">Nome da Categoria*</label>
                        <input type="text" class="form-control" id="nome_categoria_alteracao" name="nome_categoria_alteracao">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btSalvarAlteracao" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </div>
</div>