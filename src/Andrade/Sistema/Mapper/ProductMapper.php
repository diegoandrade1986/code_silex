<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:29
 */

namespace Andrade\Sistema\Mapper;
use Andrade\Sistema\Entity\Product;
use Andrade\Sistema\Db\Conexao;

class ProductMapper
{
    private $connect;

    public function __construct()
    {
        $this->connect = Conexao::getConexao();
    }

    public function insert(Product $product)
    {
        try {
            $array = [$product->getNome(), $product->getDescricao(), $product->getValor()];
            $insert = $this->connect->prepare("INSERT INTO produtos (nome, descricao, valor) VALUES  (:nome, :descricao, :valor)");
            $insert->execute($array);
            return [
                'sucess'=> true,
                'lastInsertId'=>$this->connect->lastInsertId()
            ];
        }catch(\PDOException $e){
            echo "Erro ao inserir Produto " . $e->getMessage();
            return [
                'sucess'=> false
            ];
        }
    }

    public function update($id, Product $product)
    {
        try {
            //$array = [$product->getNome(), $product->getDescricao(), $product->getValor()];
            $update = $this->connect->prepare("UPDATE produtos set nome = :nome, descricao = :descricao,
                                                valor = :valor where id = :id ");
            $update->bindValue(":id",$id,\PDO::PARAM_INT);
            $update->bindValue(":nome",$product->getNome(),\PDO::PARAM_STR);
            $update->bindValue(":descricao",$product->getDescricao(),\PDO::PARAM_STR);
            $update->bindValue(":valor",$product->getValor(),\PDO::PARAM_STR);
            $update->execute();
            if($update->rowCount() == 1) {
                return [
                    'sucess' => true,
                ];
            }else{
                return [
                    'sucess'=> false
                ];
            }
        }catch(\PDOException $e){
            echo "Erro ao alterar Produto " . $e->getMessage();
            return [
                'sucess'=> false
            ];
        }

    }
    public function delete($id)
    {
        try {
            $delete = $this->connect->prepare("DELETE from produtos where id = :id");
            $delete->bindValue(":id", $id, \PDO::PARAM_INT);
            $delete->execute();
            if ($delete->rowCount() == 1) {
                return [
                    'sucess' => true
                ];
            }else{
                return [
                    'sucess' => false
                ];
            }
        }catch(\PDOException $e) {
            return [
                'sucess' => false,
                'error' => $e->getMessage()
            ];
        }

    }
    public function find($id)
    {
        try {
            $dados = $this->connect->prepare("SELECT * FROM produtos where id = :id");
            $dados->bindValue(":id", $id, \PDO::PARAM_INT);
            $dados->execute();
            return $dados->fetch(\PDO::FETCH_OBJ);
        }catch(\PDOException $e){
            echo "Erro ao listar " .$e->getMessage();
            return [
              "sucess"=>false
            ];
        }
    }

    public function fetchAll()
    {
        $dados = $this->connect->prepare("SELECT * FROM produtos");
        $dados->execute();
        return $dados->fetchAll(\PDO::FETCH_OBJ);
    }

}