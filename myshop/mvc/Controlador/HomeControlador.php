<?php
namespace Controlador;

class HomeControlador extends Controlador
{
    public function index()
    {
        $userLogged = $this->getUsuario();
        $this->visao('home/home.php', ['userLogged' => $userLogged]);
    }
}
