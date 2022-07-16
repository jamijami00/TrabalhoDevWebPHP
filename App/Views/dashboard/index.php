<h1>Dashboard</h1>
<?php
// listando os produtos
if (isset($_SESSION['id']) && isset($_SESSION['nomeFuncionario'])) : ?>


    <div class="row">
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <i class="fas fa-user"></i> <strong>Nome</strong>
                <p class="text-muted"><?= htmlentities(utf8_encode($_SESSION['nomeFuncionario'])) ?></p>
                <i class="fas fa-id-card"></i><strong> CPF</strong>
                <p class="text-muted"><?= htmlentities(utf8_encode($_SESSION['cpfFuncionario'])) ?></p>
            </div>
        </div>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
            <a href="#" class="btn btn-outline-success">Produtos</a>
            </div>
        </div>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
            <a href="<?= url('painelfuncionario') ?>" class="btn btn-outline-primary">Funcionarios</a>
            </div>
        </div>

    </div>

<?php endif; ?>