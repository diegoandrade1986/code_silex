<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:40
 */

namespace Andrade\Sistema\Service;
use Andrade\Sistema\Entity\Cliente;
use Andrade\Sistema\Mapper\ClienteMapper;

class ClienteService
{
    private $cliente;
    private $clienteMapper;
    public function __construct(Cliente $cliente,ClienteMapper $clienteMapper)
    {
        $this->cliente = $cliente;
        $this->clienteMapper = $clienteMapper;
    }

    public function insert(array $data)
    {
        $clienteEntity = $this->cliente;
        $clienteEntity->setNome($data['nome']);
        $clienteEntity->setEmail($data['email']);

        $mapper = $this->clienteMapper;
        $result = $mapper->insert($clienteEntity);

        return $result;
    }

    public function fetchAll()
    {
        return $this->clienteMapper->fetchAll();
    }

}