<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Modelo\Produto;
use \Framework\DW3BancoDeDados;

class TesteProduto extends Teste
{
    private $usuarioId;

    public function antes()
    {
        $usuario = new Usuario('teste@teste.com', 'Teste', 'senha', 'senha');
        $usuario->salvar();
        $this->usuarioId = $usuario->getId();
    }

    public function testeInserir()
    {
        $produto = new Produto($this->usuarioId, 'Notebook', 'Notebook DELL', '3000.00');
        $produto->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM produtos WHERE id_produto = " . $produto->getId());
        $bdProduto = $query->fetch();
        $this->verificar($bdProduto['descricao'] === $produto->getDescricao());
    }

    public function testeBuscarId()
    {
        $comando = DW3BancoDeDados::prepare("SELECT descricao FROM produtos WHERE id_produto=2");
        $comando->execute();
        $bdProduto = $comando->fetch();
        $produtoBuscado = Produto::buscarId(2);
        $this->verificar($bdProduto['descricao'] === $produtoBuscado->getDescricao());
    }

    public function testeContarTodos()
    {
        $total = Produto::contarTodos();
        $this->verificar($total == 6);
    }

    public function testeBuscarTodos()
    {
        $produtos = Produto::buscarTodos(6);
        $this->verificar(count($produtos) == 6);
    }

    public function testeDestruir()
    {
        Produto::destruir(1);
        $query = DW3BancoDeDados::query('SELECT * FROM produtos WHERE id_produto = 1');
        $bdProduto = $query->fetch();
        $this->verificar($bdProduto === false);
    }
}
