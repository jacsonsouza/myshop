<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Relatorio;

class RelatoriosControlador extends Controlador
{
    public function relatorioDeCompras()
    {
        $usuarioLogado = $this->verificarLogado();

        if (!$usuarioLogado)
            $this->redirecionar(URL_RAIZ . 'login');

        $idUsuario = $this->getUsuario();
        $produtos = Relatorio::buscarRegistrosDeCompras($idUsuario);
        $this->visao('relatorios/compras.php', [
            'produtoscomprados' => $produtos,
            'usuarioLogado' => $usuarioLogado,
        ]);
    }

    public function relatorioDeVendas()
    {
        $usuarioLogado = $this->verificarLogado();

        if (!$usuarioLogado)
            $this->redirecionar(URL_RAIZ . 'login');

        $idUsuario = $this->getUsuario();
        $produtos = Relatorio::buscarRegistrosDeVendas($idUsuario);
        $this->visao('relatorios/vendas.php', [
            'produtosvendidos' => $produtos,
            'usuarioLogado' => $usuarioLogado,
        ]);
    }
}