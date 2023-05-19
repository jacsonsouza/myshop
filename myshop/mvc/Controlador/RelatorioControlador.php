<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class RelatorioControlador extends Controlador
{
    public function index()
    {
        $usuarioLogado = $this->verificarLogado();
        $idUsuario = $this->getUsuario();
        $produtos = Usuario::buscarCompras($idUsuario);
        $this->visao('relatorios/index.php',
                    ['produtoscomprados' => $produtos, 'usuarioLogado' => $usuarioLogado]);
    }
}