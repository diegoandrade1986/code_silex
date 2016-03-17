<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 10:38
 */

/*arquivo de inicializaçao
do autoload e do silex*/
require_once __DIR__."/../bootstrap.php";

/*usando o componente do sympony para usar o response*/
use Symfony\Component\HttpFoundation\Response;

$response = new Response();
/*metodo get
pegara o que vier da url*/

/*
quando alguem acessar /
vai ir pra uma funcao anonima e usando o response do sympony
*/
$app->get("/",function() use($response) {

    /*aqui o silex aguarda um response
    ou seja responder o request*/

    /*setando o conteudo do response*/
    $response->setContent("Ola Mundo");
    return $response;
});

/*aplicaçao do silex rodar*/
$app->run();