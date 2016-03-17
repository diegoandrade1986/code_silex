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

/*metodo get
pegara o que vier da url*/

/*
quando alguem acessar /
vai ir pra uma funcao anonima
*/
$app->get("/",function(){

    /*aqui o silex aguarda um response
    ou seja responder o request*/

    return "Ola Mundo";

});

/*pegando por parametros*/

$app->get("/clientes",function(){
    $clientes = array();
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
    return json_encode($clientes);
});

/*aplicaçao do silex rodar*/
$app->run();