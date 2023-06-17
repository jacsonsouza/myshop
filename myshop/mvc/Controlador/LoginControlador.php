<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class LoginControlador extends Controlador
{
    public function criar()
    {
        $usuarioLogado = $this->verificarLogado();
        $this->visao('login/criar.php', ['usuarioLogado' => $usuarioLogado]);
    }

    public function armazenar()
    {
        $usuarioLogado = $this->verificarLogado();
        $usuario = Usuario::buscarEmail($_POST['email']);
        if ($usuario && $usuario->verificarSenha($_POST['password'])) {
            DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar(URL_RAIZ . 'home');
        } else {
            $this->setErros(['login' => 'Usuário ou senha inválido.']);
            $this->visao('login/criar.php', ['usuarioLogado' => $usuarioLogado]);
        }
    }

    public function destruir()
    {
        DW3Sessao::deletar('usuario');
        $this->redirecionar(URL_RAIZ . 'login');
    }
}
