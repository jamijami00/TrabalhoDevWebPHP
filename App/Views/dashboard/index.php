<h1>Dashboard</h1>
<?php
$papel = array(
    0 => "Administrador",
    1 => "Vendedor",
    2 => "Comprador"
);

// listando os produtos
if (isset($_SESSION['id']) && isset($_SESSION['nomeFuncionario'])) : ?>


    <div class="row">
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <i class="fas fa-user"></i> <strong>Nome</strong>
                <p class="text-muted"><?= htmlentities(utf8_encode($_SESSION['nomeFuncionario'])) ?></p>
                <i class="fas fa-id-card"></i><strong> CPF</strong>
                <p class="text-muted"><?= htmlentities(utf8_encode($_SESSION['cpfFuncionario'])) ?></p>
                <i class="fas fa-id-badge"></i><strong> Papel</strong>
                <p class="text-muted"><?= htmlentities(utf8_encode($papel[$_SESSION['papelFuncionario']])) ?></p>
            </div>
        </div>
        <?php if ($_SESSION['papelFuncionario'] == 0 | $_SESSION['papelFuncionario'] == 2) : ?>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <a href="<?= url('categorias') ?>" class="btn btn-outline-primary">Categorias</a>
            </div>
        </div>
        <?php endif ?>
        <?php if ($_SESSION['papelFuncionario'] == 0 | $_SESSION['papelFuncionario'] == 1) : ?>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <a href="<?= url('clientes') ?>" class="btn btn-outline-primary">Clientes</a>
            </div>
        </div>
        <?php endif ?>
        <?php if ($_SESSION['papelFuncionario'] == 0 | $_SESSION['papelFuncionario'] == 2) : ?>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <a href="<?= url('compras') ?>" class="btn btn-outline-primary">Compras</a>
            </div>
        </div>
        <?php endif ?>
        <?php if ($_SESSION['papelFuncionario'] == 0 | $_SESSION['papelFuncionario'] == 2) : ?>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <a href="<?= url('fornecedores') ?>" class="btn btn-outline-primary">Fornecedores</a>
            </div>
        </div>
        <?php endif ?>
        <?php if ($_SESSION['papelFuncionario'] == 0) : ?>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <a href="<?= url('funcionarios') ?>" class="btn btn-outline-primary">Funcionarios</a>
            </div>
        </div>
        <?php endif ?>
        <?php if ($_SESSION['papelFuncionario'] == 0 | $_SESSION['papelFuncionario'] == 2) : ?>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <a href="#" class="btn btn-outline-primary">Produtos</a>
            </div>
        </div>
        <?php endif ?>
        <?php if ($_SESSION['papelFuncionario'] == 0 | $_SESSION['papelFuncionario'] == 1) : ?>
        <div class="card mt-3 border-0">
            <div class="card-body px-2">
                <a href="<?= url('vendas') ?>" class="btn btn-outline-primary">Vendas</a>
            </div>
        </div>
        <?php endif ?>
    </div>

<?php endif; ?>