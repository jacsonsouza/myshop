<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Mensagem;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteProduto extends Teste
{
    public function testeListagem()
    {
        $resposta = $this->get(URL_RAIZ . 'produtos');
        $this->verificarContem($resposta, 'Produtos');
        $this->verificarContem($resposta, 'Comprar');
    }

    public function testeArmazenarDeslogado()
    {
        $resposta = $this->get(URL_RAIZ . 'produtos/criar');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
    }

    public function testeArmazenar()
    {
        $this->logar();
        $resposta = $this->post(URL_RAIZ . 'produtos/criar', [
            'idUsuario' => '7',
            'nome' => 'Computador',
            'descricao' => 'Computador gamer',
            'preco' => 'R$ 3000,00',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'produtos/criar');
        $query = DW3BancoDeDados::query('SELECT * FROM produtos WHERE vendido = 0');
        $bdProdutos = $query->fetchAll();
        $this->verificar(count($bdProdutos) == 7);
    }
}
