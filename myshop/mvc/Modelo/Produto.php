<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;
use \Framework\DW3ImagemUpload;

class Produto extends Modelo
{
    const BUSCAR_TODOS = 'SELECT p.id p_id, nome_produto, descricao, preco, vendedor_id, u.nome u_nome FROM produtos p JOIN usuarios u ON (vendedor_id = u.id) WHERE vendido=0 ORDER BY p.id LIMIT ? OFFSET ?';
    const BUSCAR_ID = 'SELECT * FROM produtos WHERE id = ? LIMIT 1';
    const INSERIR = 'INSERT INTO produtos(vendedor_id, nome_produto, descricao, preco, vendido) VALUES (?, ?, ?, ?, ?)';
    const MODIFICAR = 'UPDATE produtos SET vendido = 1 WHERE id = ?';
    const INSERIR_COMPRA = 'INSERT INTO produtos_usuario(id_usuario, id_produto) VALUES (?, ?)';
    const DELETAR = 'DELETE FROM produtos WHERE id = ?';
    const CONTAR_TODOS = 'SELECT count(id) FROM produtos';

    private $id;
    private $usuarioId;
    private $nomeProduto;
    private $descricao;
    private $preco;
    private $usuario;
    private $imagem;

    public function __construct(
        $usuarioId,
        $nomeProduto,
        $descricao,
        $preco,
        $imagem = null,
        $usuario = null,
        $id = null
    ) {
        $this->id = $id;
        $this->usuarioId = $usuarioId;
        $this->nomeProduto = $nomeProduto;
        $this->descricao = $descricao;
        $this->preco = $preco;
        $this->imagem = $imagem;
        $this->usuario = $usuario;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getNomeProduto()
    {
        return $this->nomeProduto;
    }

    public function getDescricao()
    {
        return $this->descricao;
    }

    public function getPreco()
    {
        return $this->preco;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    public function getImagem()
    {
        $imagemNome = "{ $this->id}.png";

        if (!DW3ImagemUpload::existe($imagemNome)) {
            $imagemNome = 'padrao.png';
        }

        return $imagemNome;
    }

    public function salvar()
    {
        $this->inserir();
        $this->salvarImagem();
    }

    private function inserir()
    {
        DW3BancoDeDados::getPdo()->beginTransaction();
        $comando = DW3BancoDeDados::prepare(self::INSERIR);
        $comando->bindValue(1, $this->usuarioId, PDO::PARAM_INT);
        $comando->bindValue(2, $this->nomeProduto, PDO::PARAM_STR);
        $comando->bindValue(3, $this->descricao, PDO::PARAM_STR);
        $comando->bindValue(4, $this->preco, PDO::PARAM_STR);
        $comando->bindValue(5, 0, PDO::PARAM_INT);
        $comando->execute();
        $this->id = DW3BancoDeDados::getPdo()->lastInsertId();
        DW3BancoDeDados::getPdo()->commit();
    }

    private function salvarImagem()
    {
    
        if (DW3ImagemUpload::isValida($this->imagem)) {
            $nomeCompleto = PASTA_PUBLICO . "img/{$this->id}.png";
            DW3ImagemUpload::salvar($this->imagem, $nomeCompleto);
        }
    }

    public static function buscarId($id)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_ID);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
        $objeto = null;
        $registro = $comando->fetch();
        if ($registro) {
            $objeto = new Produto(
                $registro['vendedor_id'],
                $registro['nome_produto'],
                $registro['descricao'],
                $registro['preco'],
                null,
                null,
                $registro['id']
            );
        }
        return $objeto;
    }

    /* Além de buscar as mensagens, eu também busco, na mesma consulta,
    os dados dos usuários, usando um JOIN. Essa é a forma correta de
    resolver o problema: query N+1. Com apenas uma consulta no banco
    eu busco tudo que eu preciso.
    */
    public static function buscarTodos($limit = 4, $offset = 0)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_TODOS);
        $comando->bindValue(1, $limit, PDO::PARAM_INT);
        $comando->bindValue(2, $offset, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach ($registros as $registro) {
            $usuario = new Usuario(
                '',
                $registro['u_nome'],
                null,
                '',
                $registro['vendedor_id']
            );
            $objetos[] = new Produto(
                null,
                $registro['nome_produto'],
                $registro['descricao'],
                $registro['preco'],
                null,
                $usuario,
                $registro['p_id']
            );
        }
        return $objetos;
    }

    public static function contarTodos()
    {
        $registros = DW3BancoDeDados::query(self::CONTAR_TODOS);
        $total = $registros->fetch();
        return intval($total[0]);
    }

    public static function destruir($id)
    {
        $comando = DW3BancoDeDados::prepare(self::DELETAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    protected function verificarErros()
    {
        if (strlen($this->texto) < 3) {
            $this->setErroMensagem('texto', 'Mínimo 3 caracteres.');
        }

        if (DW3ImagemUpload::existeUpload($this->imagem) 
                && !DW3ImagemUpload::isValida($this->imagem)) {
                    $this->setErroMensagem('imagem', 'Deve ser de no máximo 500 kb');
        } 
    }

    public static function modificar($id)
    {
        $comando = DW3BancoDeDados::prepare(self::MODIFICAR);
        $comando->bindValue(1, $id, PDO::PARAM_INT);
        $comando->execute();
    }

    public static function inserirCompra($idUsuario, $idProduto)
    {
        $comando = DW3BancoDeDados::prepare(self::INSERIR_COMPRA);
        $comando->bindValue(1, $idUsuario, PDO::PARAM_INT);
        $comando->bindValue(2, $idProduto, PDO::PARAM_INT);
        $comando->execute();
    }
}
