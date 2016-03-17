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
use Andrade\Sistema\Service\ClienteService;
use Andrade\Sistema\Entity\Cliente;
use Andrade\Sistema\Mapper\ClienteMapper;

/* BASEADO NA BIBLIOTECA PIMPPLE QUE E UM SERVICE CONTAINER
REGISTRANDO UMA FUNCAO NO clienteService PARA TIRAR DO RESPONSE */
$app['clienteService'] = function (){
    $clienteEntity = new Cliente();
    $clienteMapper = new ClienteMapper();
    $clienteService = new ClienteService($clienteEntity,$clienteMapper);
    return $clienteService;
};
/*metodo get
pegara o que vier da url*/

/*
quando alguem acessar /
vai ir pra uma funcao anonima
*/
$app->get("/",function() use($app){

    /*aqui o silex aguarda um response
    ou seja responder o request*/

    return $app['twig']->render('index.twig',[]);

})->bind("index") ;

$app->get("/ola/{nome}",function($nome) use($app){

    /*aqui o silex aguarda um response
    ou seja responder o request*/

    return $app['twig']->render('ola.twig',['nome'=>$nome]);

});


/*pegando por parametros*/

$app->get("/clientes",function() use ($app){
    /*Listando os dados
    usando os meu serviço e o servico do twig
    */
    $dados = $app['clienteService']->fetchAll();

    /*RENDERIZANDO O TWIG e passando um array com os dados do cliente*/
    return $app['twig']->render("clientes.twig",['clientes'=>$dados]);

    /*$clientes = array();
    $clientes[] = array('nome'=>"Diego Andrade","email"=>"diego@email.com.br","cpf"=>"123.456.789-88");
    $clientes[] = array('nome'=>"Vanita","email"=>"Vanita@email.com.br","cpf"=>"789.541.369-01");
    $clientes[] = array('nome'=>"Maria","email"=>"Maria@email.com.br","cpf"=>"987.741.364-05");
    $clientes[] = array('nome'=>"Joao","email"=>"Joao@email.com.br","cpf"=>"854.001.140-01");
    $clientes[] = array('nome'=>"Jose","email"=>"Jose@email.com.br","cpf"=>"059.905.154-01");
    $clientes[] = array('nome'=>"Ana","email"=>"Ana@email.com.br","cpf"=>"212.413.001-01");
    $clientes[] = array('nome'=>"Joaquim","email"=>"Joaquim@email.com.br","cpf"=>"301.102.301-01");
    $clientes[] = array('nome'=>"Carlos","email"=>"Carlos@email.com.br","cpf"=>"103.054.193-01");
    $clientes[] = array('nome'=>"Carla","email"=>"Carla@email.com.br","cpf"=>"123.789.257-79");
    $clientes[] = array('nome'=>"Debora","email"=>"Debora@email.com.br","cpf"=>"789.541.369-01");
    return json_encode($clientes);*/
})->bind("clientes");

$app->get("/cliente",function() use ($app){
    $dados['nome'] = 'Cliente';
    $dados['email'] = 'email@cliente';

    /*POR UTILIZAR O use $app*/
    $result = $app['clienteService']->insert($dados);
    return $app->json($result);
});

/*aplicaçao do silex rodar*/
$app->run();