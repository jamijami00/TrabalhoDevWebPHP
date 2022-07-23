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
            <th>Endereço</th>
            <th>Bairro</th>
            <th>Cidade</th>
            <th>UF</th>
            <th>CEP</th>
            <th>Telefone</th>
            <th>E-mail</th>
            <th>Ação</th>
        </tr>
    </thead>
    <tbody name="contudoTabela" id="contudoTabela">
    <?php
        $clientes = $data['clientes'];
        if (!empty($clientes)) :
            foreach ($clientes as $cliente) { 
                ?>
                <tr>
                    <td> <?= $cliente['id'] ?> </td>
                    <td> <?= $cliente['nome'] ?> </td>
                    <td> <?= $cliente['cpf'] ?> </td>
                    <td> <?= $cliente['endereco'] ?> </td>
                    <td> <?= $cliente['bairro'] ?> </td>
                    <td> <?= $cliente['cidade'] ?> </td>
                    <td> <?= $cliente['uf'] ?> </td>
                    <td> <?= $cliente['cep'] ?> </td>
                    <td> <?= $cliente['telefone'] ?> </td>
                    <td> <?= $cliente['email'] ?> </td>
                    <td>
                        <button type="button" id="btAlterar" class="btn btn-outline-primary" data-id="<?= $cliente['id'] ?>" data-nome="<?= $cliente['nome'] ?>">
                            Alterar
                        </button>
                        <button type="button" id="btExcluir" class="btn btn-outline-danger" data-id="<?= $cliente['id'] ?>">
                            Excluir
                        </button>
                    </td>
                </tr>
            <?php }
        else :
            echo "Não há clientes";
        endif;
    ?>
    </tbody>
</table>

<div id="pagination_link"></div>

<!-- Modal Inclusão da cliente-->
<div class="modal fade" id="modalNovoCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Novo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= url('cliente') ?>" id="formInclusao" method="POST">
                    <div id="mensagem_erro" name="mensagem_erro"></div>
                    <input type="hidden" id="CSRF_token" name="CSRF_token" value="" required/>
                    <div class="form-group">
                        <label for="nome">Nome*</label>
                        <input type="text" class="form-control" id="nome" name="nome" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF*</label>
                        <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço*</label>
                        <input type="text" class="form-control" id="endereco" name="endereco" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="bairro">Bairro*</label>
                        <input type="text" class="form-control" id="bairro" name="bairro" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade">Cidade*</label>
                        <input type="text" class="form-control" id="cidade" name="cidade" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="uf">UF*</label>
                        <input type="text" class="form-control" id="uf" name="uf" maxlength="2" required>
                    </div>
                    <div class="form-group">
                        <label for="cep">CEP*</label>
                        <input type="text" class="form-control" id="cep" name="cep" maxlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone*</label>
                        <input type="tel" class="form-control" id="telefone" name="telefone" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail*</label>
                        <input type="email" class="form-control" id="email" name="email" maxlength="50" required>
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

<!-- Modal alteracao do cliente-->
<div class="modal fade" id="modalAlterarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Alterar Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form action="<?= url ('gravaralteracao') ?>" id="formAltercao" method="PUT">

                    <div id="mensagem_erro_alteracao" name="mensagem_erro_alteracao"></div>

                    <input type="hidden" id="CSRF_token" name="CSRF_token" value="" required/>
                    <input type="hidden" id="id_alteracao" name="id_alteracao" value="" required/>

                    <div class="form-group">
                        <label for="nome_alteracao">Nome*</label>
                        <input type="text" class="form-control" id="nome_alteracao" name="nome_alteracao" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="cpf_alteracao">CPF*</label>
                        <input type="text" class="form-control" id="cpf_alteracao" name="cpf_alteracao" maxlength="14" required>
                    </div>
                    <div class="form-group">
                        <label for="endereco_alteracao">Endereço*</label>
                        <input type="text" class="form-control" id="endereco_alteracao" name="endereco_alteracao" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="bairro_alteracao">Bairro*</label>
                        <input type="text" class="form-control" id="bairro_alteracao" name="bairro_alteracao" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="cidade_alteracao">Cidade*</label>
                        <input type="text" class="form-control" id="cidade_alteracao" name="cidade_alteracao" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label for="uf_alteracao">UF*</label>
                        <input type="text" class="form-control" id="uf_alteracao" name="uf_alteracao" maxlength="2" required>
                    </div>
                    <div class="form-group">
                        <label for="cep_alteracao">CEP*</label>
                        <input type="text" class="form-control" id="cep_alteracao" name="cep_alteracao" maxlength="8" required>
                    </div>
                    <div class="form-group">
                        <label for="telefone_alteracao">Telefone*</label>
                        <input type="tel" class="form-control" id="telefone_alteracao" name="telefone_alteracao" maxlength="20" required>
                    </div>
                    <div class="form-group">
                        <label for="email_alteracao">E-mail*</label>
                        <input type="email" class="form-control" id="email_alteracao" name="email_alteracao" maxlength="50" required>
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