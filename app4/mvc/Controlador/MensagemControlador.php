<?php
namespace Controlador;

use \Framework\DW3Sessao;
use \Modelo\Mensagem;

class MensagemControlador extends Controlador
{
    public function index()
    {
        $this->verificarLogado();
        $pagina = array_key_exists('p', $_GET) ? intval($_GET['p']) : 1;
        $offset = ($pagina - 1) * 4;
        $mensagens = Mensagem::buscarTodos($offset);
        $ultimaPagina = ceil(Mensagem::contarTodos() / 4.0);
        $this->visao('mensagens/index.php', [
            'mensagens' => $mensagens,
            'pagina' => $pagina,
            'ultimaPagina' => $ultimaPagina
        ]);
    }

    public function armazenar()
    {
        $this->verificarLogado();
        $mensagem = new Mensagem(
            DW3Sessao::get('usuario'),
            $_POST['texto']
        );
        if ($mensagem->isValido()) {
            $mensagem->salvar();
            $this->redirecionar(URL_RAIZ . 'mensagens');

        } else {
            $this->setErros($mensagem->getValidacaoErros());
            $this->visao('mensagens/index.php', [
                'mensagens' => Mensagem::buscarTodos()
            ]);
        }
    }

    public function destruir($id)
    {
        $this->verificarLogado();
        Mensagem::destruir($id);
        $this->redirecionar(URL_RAIZ . 'mensagens');
    }
}
