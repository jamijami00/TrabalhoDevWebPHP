<?php

$route = new \CoffeeCode\Router\Router(URL_BASE);
/**
 * APP
 */
$route->namespace("App\Controllers");
/**
 * parte publica
 */
$route->get("/", "Produto:index");
$route->get("/produtos", "Produto:index");
$route->get("/login", "AcessoRestrito:login");
$route->post("/logar", "AcessoRestrito:logar");  // <= rota para metodo POST do from login
/**
 * parte restrita
 */

$route->get("/clientes", "Cliente:index");
$route->get("/compras", "Compra:index");
$route->get("/fornecedores", "Fornecedor:index");
$route->get("/funcionarios", "Funcionario:index");
$route->get("/vendas", "Venda:index");
$route->get("/Dashboard", "Dashboard:index");
$route->get("/logout", "AcessoRestrito:logout");
/**
 * parte restrita - Categorias
 */

$route->get("/categorias", "Categoria:index");
$route->post("/categoria", "Categoria:gravarInclusao");
$route->get("/categoria/{id}", "Categoria:show");
$route->put("/categoria/{id}", "Categoria:gravarAlterar");
$route->delete("/categoria/{id}", "Categoria:excluirCategoria");

/**
 * parte restrita - Clientes
 */
$route->get("/clientes", "Cliente:index");
$route->post("/cliente", "Cliente:gravarInclusao");
$route->get("/cliente/{id}", "Cliente:show");
$route->put("/cliente/{id}", "Cliente:gravarAlterar");
$route->delete("/cliente/{id}", "Cliente:excluirCliente");
//$route->get("/clientes/incluircliente", "Cliente:incluir");
//$route->post("/clientes/salvarinclusao", "Cliente:gravarInclusao");
// o controlador receber o parâmetro como um array $data['numPag']
//$route->get("/clientes/navega/{numPag}", "Cliente:ajax_lista");
// o controlador receber o parâmetro como um array $data['id']
//$route->get("/clientes/alteracaocliente/{id}", "Cliente:alterarCliente");
//$route->post("/clientes/gravaralteracao", "Cliente:gravarAlterar");
// o controlador receber o parâmetro como um array $data['id']
//$route->get("/clientes/excluirucliente/{id}", "Cliente:excluirCCliente");
/**
 * parte restrita - Compras
 */
/**
 * parte restrita - Fornecedores
 */
/**
 * parte restrita - Funcionários
 */
/**
 * parte restrita - Produtos
 */
/**
 * parte restrita - Vendas
 */
/**
 * ERROR
 */
$route->group("ops");
$route->get("/{errcode}", "Web:error");
/**
 * PROCESS
 */
$route->dispatch();

if ($route->error()) {
    $route->redirect("/ops/{$route->error()}");
}