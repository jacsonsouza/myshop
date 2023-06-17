<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3Sessao;

class TesteLogin extends Teste
{
    public function testeAcessar()
    {
        $resposta = $this->get(URL_RAIZ . 'login');
        $this->verificarContem($resposta, 'z');
    }

    public function testeLogin()
    {
        (new Usuario('joao@teste.com', 'João', '123', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'password' => '123',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'home');
        $this->verificar(DW3Sessao::get('usuario') != null);
    }

    public function testeLoginInvalido()
    {
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'senha' => '123',
        ]);
        //$this->verificarContem($resposta, 'joao@teste.com');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }

    public function testeDeslogar()
    {
        (new Usuario('joao@teste.com', 'João', '123', '123'))->salvar();
        $resposta = $this->post(URL_RAIZ . 'login', [
            'email' => 'joao@teste.com',
            'password' => '123'
        ]);
        $resposta = $this->get(URL_RAIZ . 'logout');
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'login');
        $this->verificar(DW3Sessao::get('usuario') == null);
    }
}
