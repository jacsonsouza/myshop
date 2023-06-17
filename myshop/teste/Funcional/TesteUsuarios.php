<?php
namespace Teste\Funcional;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuarios extends Teste
{
    public function testeCriar()
    {
        $resposta = $this->get(URL_RAIZ . 'usuarios/criar');
        $this->verificarContem($resposta, 'Cadastrar');
    }

    public function testeArmazenar()
    {
        $resposta = $this->post(URL_RAIZ . 'usuarios', [
            'email' => 'joao@teste.com',
            'full-name' => 'Joao Antonio',
            'password' => 'teste12345',
            'confirm-password' => 'teste12345',
        ]);
        $this->verificarRedirecionar($resposta, URL_RAIZ . 'home');
        $query = DW3BancoDeDados::query('SELECT * FROM usuarios WHERE email = "joao@teste.com"');
        $bdUsuarios = $query->fetchAll();
        $this->verificar(count($bdUsuarios) == 1);
    }
}
