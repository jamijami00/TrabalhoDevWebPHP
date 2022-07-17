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
$route->get("/categorias", "Categoria:index");
$route->get("/Dashboard", "Dashboard:index");
$route->get("/logout", "AcessoRestrito:logout");
/**
 * parte restrita - Categorias
 */
$route->get("/incluircategoria", "Categoria:incluir");
$route->post("/salvarinclusao", "Categoria:gravarInclusao");
// o controlador receber o parâmetro como um array $data['numPag']
$route->get("/navega/{numPag}", "Categoria:ajax_lista");
// o controlador receber o parâmetro como um array $data['id']
$route->get("/alteracaocategoria/{id}", "Categoria:alterarUsuario");
$route->post("/gravaralteracao", "Categoria:gravarAlterar");
// o controlador receber o parâmetro como um array $data['id']
$route->get("/excluirucategoria/{id}", "Categoria:excluirCategoria");
/**
 * parte restrita - funcionários
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