<?php
namespace Controlador;

use \Modelo\Produto;

class HomeControlador extends Controlador
{
    public function index()
    {
        $usuarioLogado = $this->verificarLogado();
        $idUsuario = $this->getUsuario();
        $produtos = Produto::buscarRandom(3);
        $this->visao('home/home.php', [
            'usuarioLogado' => $usuarioLogado, 
            'produtos' => $produtos, 
            'idUsuario' => $idUsuario,
        ]);
    }
}
