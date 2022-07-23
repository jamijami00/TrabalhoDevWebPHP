<!-- Button trigger modal -->
<button type="button" id="btIncluir" class="btn btn-outline-primary mb-1">
    Novo
</button>
<a href="<?= url('Dashboard') ?>" class="btn btn-outline-primary mb-1">Voltar</a>
<input type="hidden" id="CSRF_token" name="CSRF_token" value="" data-token = "<?= $data['token'] ?>"/>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>Papel</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody name="contudoTabela" id="contudoTabela">
    <?php
        $funcionarios = $data['funcionarios'];
        if (!empty($funcionarios)) :
            foreach ($funcionarios as $funcionario) { 
                ?>
                <tr>
                    <td> <?= $funcionario['id'] ?> </td>
                    <td> <?= $funcionario['nome'] ?> </td>
                    <td> <?= $funcionario['cpf'] ?> </td>
                    <td> <?= $funcionario['papel'] ?> </td>
                    <td>
                        <button type="button" id="btAlterar" class="btn btn-outline-primary" data-id="<?= $funcionario['id'] ?>" data-nome="<?= $funcionario['nome'] ?>">
                            Alterar
                        </button>
                        <button type="button" id="btExcluir" class="btn btn-outline-danger" data-id="<?= $funcionario['id'] ?>">
                            Excluir
                        </button>
                    </td>
                </tr>
            <?php }
        else :
            echo "Não há funcionarios";
        endif;
    ?>
    </tbody>
</table>

<div id="pagination_link"></div>


<!-- Modal Inclusão da funcionario-->
<div class="modal fade" id="modalNew" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Funcionario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('funcionario') ?>" id="formInclusao" method="POST">
                    <div id="mensagem_erro" name="mensagem_erro"></div>
                    <input type="hidden" id="CSRF_token" name="CSRF_token" value="" />
                    <div class="form-group">
                        <label for="nome">Nome do Funcionario*</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF*</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="senha">Senha*</label>
                        <input type="password" class="form-control" id="senha" name="senha" required>
                    </div>
                    <div class="form-group">
                        <label for="papel">Papel*</label>
                        <input type="text" class="form-control" id="papel" name="papel" required>
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

<!-- Modal alteracao da funcionario-->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Funcionario</h5>
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
                        <label for="nome_alteracao">Nome do Funcionario*</label>
                        <input type="text" class="form-control" id="nome_alteracao" name="nome_alteracao" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf_alteracao">CPF*</label>
                        <input type="text" class="form-control" id="cpf_alteracao" name="cpf_alteracao" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="senha_alteracao">Senha*</label>
                        <input type="password" class="form-control" id="senha_alteracao" name="senha_alteracao" required>
                    </div>
                    <div class="form-group">
                        <label for="papel_alteracao">Papel*</label>
                        <input type="text" class="form-control" id="papel_alteracao" name="papel_alteracao" required>
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