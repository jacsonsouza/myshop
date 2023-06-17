<?php
namespace Teste\Unitario;

use \Teste\Teste;
use \Modelo\Usuario;
use \Framework\DW3BancoDeDados;

class TesteUsuario extends Teste
{
	public function testeInserir()
	{
        $usuario = new Usuario('teste@teste.com', 'teste', 'senha', 'senha');
        $usuario->salvar();
        $query = DW3BancoDeDados::query("SELECT * FROM usuarios WHERE email = 'teste@teste.com'");
        $bdUsuairo = $query->fetch();
        $this->verificar($bdUsuairo !== false);
	}

    public function testeBuscarEmail()
    {
        $usuario = new Usuario('teste@teste.com', 'teste', 'senha', 'senha');
        $usuario->salvar();
        $usuario = Usuario::buscarEmail('teste@teste.com');
        $this->verificar($usuario !== false);
    }
}
