<?php
namespace Controlador;

use \Modelo\Produto;

class BuscaControlador extends Controlador
{
    public function index()
    {
        $usuarioLogado = $this->verificarLogado();
        $idUsuario = $this->getUsuario();
        $this->visao('busca/index.php', [
            'usuarioLogado' => $usuarioLogado, 
            'registrosBuscados' => Produto::pesquisar($_GET),
            'idUsuario' => $idUsuario,
        ]);
    }
}
?>