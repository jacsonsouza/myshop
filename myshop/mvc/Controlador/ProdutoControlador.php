<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Produto;

class ProdutoControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 3;
        $offset = ($pagina - 1) * $limit;
        $produtos = Produto::buscarTodos($limit, $offset);
        $ultimaPagina = ceil(Produto::contarTodos() / $limit);
        return compact('pagina', 'produtos', 'ultimaPagina');
    }

    public function index()
    {
        $paginacao = $this->calcularPaginacao();
        $usuarioLogado = $this->verificarLogado();
        $idUsuario = $this->getUsuario();
        $this->visao('produtos/index.php', [
            'produtos' => $paginacao['produtos'],
            'pagina' => $paginacao['pagina'],
            'ultimaPagina' => $paginacao['ultimaPagina'],
            'usuarioLogado' => $usuarioLogado,
            'idUsuario' => $idUsuario,
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash'),
        ]);
    }

    public function cadastro()
    {
        $usuarioLogado = $this->verificarLogado();

        if (!$usuarioLogado)
            $this->redirecionar(URL_RAIZ . 'login');

        $this->visao('produtos/criar.php', [
            'usuarioLogado' => $usuarioLogado,
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash'),
        ]);
    }

    public function armazenar()
    {
        $usuarioLogado = $this->verificarLogado();

        $this->verificarLogado();
        $imagem = array_key_exists('imagem', $_FILES) ? $_FILES['imagem'] : null;
        $produto = new Produto(
            DW3Sessao::get('usuario'),
            $_POST['nome'],
            $_POST['descricao'],
            floatval(str_replace(',', '.', substr($_POST['preco'], 2))),
            $imagem
        );
        if ($produto->isValido()) {
            $produto->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Produto cadastrado.');
            $this->redirecionar(URL_RAIZ . 'produtos/criar');
        } else {
            $this->setErros($produto->getValidacaoErros());
            $this->visao('produtos/criar.php', [
                'usuarioLogado' => $usuarioLogado,
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash'),
            ]);
        }
    }

    public function vender($id)
    {
        $usuarioLogado = $this->verificarLogado();

        if (!$usuarioLogado)
            $this->redirecionar(URL_RAIZ . 'login');

        $produto = Produto::buscarId($id);
        $idUsuario = $this->getUsuario();
        Produto::modificar($id);
        Produto::inserirCompra($idUsuario, $id);
        DW3Sessao::setFlash('mensagemFlash', 'Produto comprado com sucesso!');
        $this->redirecionar(URL_RAIZ . 'produtos');
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $produto = Produto::buscarId($id);
        if ($produto->getUsuarioId() == $this->getUsuario()) {
            Produto::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Produto deletado com sucesso!');
        }
        $this->redirecionar(URL_RAIZ . 'produtos');
    }
}
