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
        'DELETE' => '\Controlador\LoginControlador#destruir',
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
    '/usuarios/sucesso' => [
        'GET' => '\Controlador\UsuarioControlador#sucesso',
    ],
    '/produtos' => [
        'GET' => '\Controlador\ProdutoControlador#index',
    ],
    '/produtos/cadastrar' => [
        'GET' => '\Controlador\ProdutoControlador#cadastro',
        'POST' => '\Controlador\ProdutoControlador#armazenar',
    ],
    '/produtos/?' => [
        'GET' => '\Controlador\ProdutoControlador#vender',
        'DELETE' => '\Controlador\ProdutoControlador#destruir',
    ],
    '/relatorios' => [
        'GET' => '\Controlador\RelatorioControlador#index'
    ],
];
