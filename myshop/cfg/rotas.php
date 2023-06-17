<?php

$rotas = [
    '/' => [
        'GET' => '\Controlador\RaizControlador#index',
    ],
    '/home' => [
        'GET' => '\Controlador\HomeControlador#index',
    ],
    '/login' => [
        'GET' => '\Controlador\LoginControlador#criar',
        'POST' => '\Controlador\LoginControlador#armazenar',
    ],
    '/logout' => [
        'GET' => '\Controlador\LoginControlador#destruir'
    ],
    '/usuarios' => [
        'POST' => '\Controlador\UsuarioControlador#armazenar',
    ],
    '/usuarios/criar' => [
        'GET' => '\Controlador\UsuarioControlador#criar',
    ],
    '/produtos' => [
        'GET' => '\Controlador\ProdutoControlador#index',
    ],
    '/produtos/criar' => [
        'GET' => '\Controlador\ProdutoControlador#cadastro',
        'POST' => '\Controlador\ProdutoControlador#armazenar',
    ],
    '/produtos/?' => [
        'GET' => '\Controlador\ProdutoControlador#vender',
        'DELETE' => '\Controlador\ProdutoControlador#destruir',
    ],
    '/compras' => [
        'GET' => '\Controlador\RelatoriosControlador#relatorioDeCompras',
    ],
    '/vendas' => [
        'GET' => '\Controlador\RelatoriosControlador#relatorioDeVendas',
    ],
    '/busca' => [
        'GET' => '\Controlador\BuscaControlador#index',
    ],
];
