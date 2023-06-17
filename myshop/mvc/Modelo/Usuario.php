<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Usuario extends Modelo
{
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(email, nome, senha) VALUES (?, ?, ?)';

    private $id;
    private $email;
    private $nome;
    private $senha;
    private $senhaPlana;
    private $confirmaSenha;

    public function __construct(
        $email,
        $nome,
        $senhaPlana,
        $confirmaSenha,
        $id = null
    ) {
        $this->id = $id;
        $this->email = $email;
        $this->nome = $nome;
        $this->senhaPlana = $senhaPlana;
        $this->confirmaSenha = $confirmaSenha;
        if ($senhaPlana != null) {
            $this->senha = password_hash($senhaPlana, PASSWORD_BCRYPT);
        }
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function verificarSenha($senhaPlana)
    {
        return password_verify($senhaPlana, $this->senha);
    }

    protected function verificarErros()
    {
        $emailExistente = $this::buscarEmail($this->email);

        if($emailExistente) 
            $this->setErroMensagem('email', 'E-mail informado já existe!');

        if (strlen($this->email) < 3) {
            $this->setErroMensagem('email', 'Precisa ser um e-mail válido!');
        }

        if (strlen($this->nome) < 3) {
            $this->setErroMensagem('full-name', 'Mínimo 3 caracteres!');
        }
        
        if (strlen($this->senhaPlana) < 10) {
            $this->setErroMensagem('senha', 'Mínimo 10 caracteres.');
        }

        if ($this->senhaPlana !== $this->confirmaSenha) {
            $this->setErroMensagem('confirm-password', 'Senhas não correspondem.');
        }
    }

    public function salvar()
    {
        $this->inserir();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->email, PDO::PARAM_STR);
        $comando->bindValue(2, $this->nome, PDO::PARAM_STR);
        $comando->bindValue(3, $this->senha, PDO::PARAM_STR);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    public static function buscarEmail($email)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_POR_EMAIL);
        $comando->bindValue(1, $email, PDO::PARAM_STR);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Usuario(
                $registro['email'],
                '',
                '',
                '',
                
                $registro['id_usuario']
            );
            $objeto->senha = $registro['senha'];
        }
        return $objeto;
    }
}
