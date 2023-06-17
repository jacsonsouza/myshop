<?php
namespace Modelo;

use \PDO;
use \Framework\DW3BancoDeDados;

class Relatorio
{
    const BUSCAR_COMPRAS = 'SELECT id_produtos_usuario, nome_produto, descricao, preco, DATE_FORMAT(date, "%d/%m/%Y") AS "data" FROM usuarios JOIN produtos_usuario USING (id_usuario) JOIN produtos USING (id_produto) WHERE id_usuario = ?';
    const BUSCAR_VENDAS = 'SELECT id_produtos_usuario, nome_produto, descricao, preco, nome FROM produtos JOIN produtos_usuario USING(id_produto) JOIN usuarios USING (id_usuario) WHERE vendedor_id=? AND vendido=1';

    public static function buscarRegistrosDeCompras($idUsuario)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_COMPRAS);
        $comando->bindValue(1, $idUsuario, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach($registros as $registro) {
            $produtoComprado = [
                'nome' => $registro['nome_produto'],
                'descricao' => $registro['descricao'],
                'preco' => $registro['preco'],
                'data' => $registro['data'],
                'id' => $registro['id_produtos_usuario'],
            ];

            $objetos[] = $produtoComprado;
        }

        return $objetos;
    }

    public static function buscarRegistrosDeVendas($idUsuario)
    {
        $comando = DW3BancoDeDados::prepare(self::BUSCAR_VENDAS);
        $comando->bindValue(1, $idUsuario, PDO::PARAM_INT);
        $comando->execute();
        $registros = $comando->fetchAll();
        $objetos = [];
        foreach($registros as $registro) {
            $produtoVendido = [
                'nome' => $registro['nome_produto'],
                'descricao' => $registro['descricao'],
                'preco' => $registro['preco'],
                'id' => $registro['id_produtos_usuario'],
                'nomeComprador' => $registro['nome'],
            ];

            $objetos[] = $produtoVendido;
        }

        return $objetos;
    }
}