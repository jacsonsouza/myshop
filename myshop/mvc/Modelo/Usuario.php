<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
//use \Framework\DW3ImagemUpload;

class Usuario extends Modelo
{
    const BUSCAR_POR_EMAIL = 'SELECT * FROM usuarios WHERE email = ? LIMIT 1';
    const INSERIR = 'INSERT INTO usuarios(email, nome, senha) VALUES (?, ?, ?)';
    const BUSCAR_COMPRAS = 'SELECT id_produtos_usuario, nome_produto, descricao, preco, DATE_FORMAT(date, "%d/%m/%Y") AS "data" FROM usuarios JOIN produtos_usuario USING (id_usuario) JOIN produtos USING (id_produto) WHERE id_usuario = ?';
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
        if (strlen($this->email) < 3) {
            $this->setErroMensagem('email', 'Deve ter no mínimo 3 caracteres.');
        }
        if (strlen($this->senhaPlana) < 3) {
            $this->setErroMensagem('senha', 'Deve ter no mínimo 3 caracteres.');
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

    public static function buscarCompras($idUsuario)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_COMPRAS);
        $comando->bindValue(1, $idUsuario, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach($registros as $registro) {
            $produtoComprado = ['nome' => $registro['nome_produto'],
                     'descricao' => $registro['descricao'],
                     'preco' => $registro['preco'],
                     'data' => $registro['data'],
                     'id' => $registro['id_produtos_usuario'],
                    ];

            $objetos[] = $produtoComprado;
        }

        return $objetos;
    }
}
