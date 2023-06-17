<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Usuario;

class UsuarioControlador extends Controlador
{
    public function criar()
    {
        $usuarioLogado = $this->verificarLogado();
        $this->visao('usuarios/criar.php', ['usuarioLogado' => $usuarioLogado]);
    }

    public function armazenar()
    {
        $usuarioLogado = $this->verificarLogado();
        $usuario = new Usuario($_POST['email'],$_POST['full-name'], $_POST['password'], $_POST['confirm-password']);
        if ($usuario->isValido()) {
            $usuario->salvar();
            DW3Sessao::set('usuario', $usuario->getId());
            $this->redirecionar(URL_RAIZ . 'home');  
        } else {
            $this->setErros($usuario->getValidacaoErros());
            $this->visao('usuarios/criar.php', ['usuarioLogado' => $usuarioLogado]);
        }
    }
}
