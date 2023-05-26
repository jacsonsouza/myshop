<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Produto;

class ProdutoControlador extends Controlador
{
    private function calcularPaginacao()
    {
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $limit = 9;
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
            'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash'),
            'usuarioLogado' => $usuarioLogado,
            'idUsuario' => $idUsuario,
        ]);
    }

    public function cadastro()
    {
        $usuarioLogado = $this->verificarLogado();
        $this->visao('produtos/cadastrar.php', [
            'usuarioLogado' => $usuarioLogado
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $imagem = array_key_exists('imagem', $_FILES) ? $_FILES['imagem'] : null;
        $produto = new Produto(
            DW3Sessao::get('usuario'),
            $_POST['nome'],
            $_POST['descricao'],
            $_POST['preco'],
            $imagem
        );
        if ($produto->isValido()) {
            $produto->salvar();
            DW3Sessao::setFlash('mensagemFlash', 'Produto cadastrado.');
            $this->redirecionar(URL_RAIZ . 'produtos');

        } else {
            $paginacao = $this->calcularPaginacao();
            $this->setErros($mensagem->getValidacaoErros());
            $this->visao('produtos/index.php', [
                'produtos' => $paginacao['produtos'],
                'pagina' => $paginacao['pagina'],
                'ultimaPagina' => $paginacao['ultimaPagina'],
                'mensagemFlash' => DW3Sessao::getFlash('mensagemFlash')
            ]);
        }
    }

    public function vender($id)
    {
        $usuarioLogado = $this->verificarLogado();

        if (!$usuarioLogado)


        $produto = Produto::buscarId($id);
        $idUsuario = $this->getUsuario();
        Produto::modificar($id);
        Produto::inserirCompra($idUsuario, $id);
        $this->redirecionar(URL_RAIZ . 'produtos');
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        $produto = Produto::buscarId($id);
        if ($produto->getUsuarioId() == $this->getUsuario()) {
            Produto::destruir($id);
            DW3Sessao::setFlash('mensagemFlash', 'Mensagem destruida.');
        } else {
            DW3Sessao::setFlash('mensagemFlash', 'Você não pode deletar as mensagens dos outros.');
        }
        $this->redirecionar(URL_RAIZ . 'produtos');
    }
}
