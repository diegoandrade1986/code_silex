<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 12:29
 */

namespace Andrade\Sistema\Mapper;
use Andrade\Sistema\Entity\Cliente;

class ClienteMapper
{
    public function insert(Cliente $cliente)
    {
        return [
            'nome'=> 'Cliente X',
            'email' => 'email@clientex.com'
        ];
    }

    public function fetchAll()
    {
        $dados[0]['nome'] = "Cliente XPTO";
        $dados[0]['email'] = "Clientexptoo@email.com";

        $dados[1]['nome'] = "Cliente Y";
        $dados[1]['email'] = "Clientey@email.com";

        return $dados;
    }

}