<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:40
 */

namespace Andrade\Sistema\Service;
use Andrade\Sistema\Entity\Product;
use Andrade\Sistema\Mapper\ProductMapper;

class ProductService
{
    private $product;
    private $productMapper;
    public function __construct(Product $product,ProductMapper $productMapper)
    {
        $this->product = $product;
        $this->productMapper = $productMapper;
    }

    public function insert(array $data)
    {
        $productEntity = $this->product;
        $productEntity->setNome($data['nome']);
        $productEntity->setDescricao($data['descricao']);
        $productEntity->setValor(number_format($data['valor'],2,".",","));
        $mapper = $this->productMapper;
        $result = $mapper->insert($productEntity);
        return $result;
    }
    public function update($id,array $data)
    {
        $productEntity = $this->product;
        $productEntity->setNome($data['nome']);
        $productEntity->setDescricao($data['descricao']);
        $productEntity->setValor(number_format($data['valor'],2,".",","));
        $mapper = $this->productMapper;
        $result = $mapper->update($id, $productEntity);
        return $result;
    }

    public function fetchAll()
    {
        return $this->productMapper->fetchAll();
    }

    public function find($id)
    {
        if ((int)$id) {
            return $this->productMapper->find($id);
        }else{
            return [
                "sucess" => false
            ];
        }
    }
    public function delete($id)
    {
        return $this->productMapper->delete($id);
    }

}