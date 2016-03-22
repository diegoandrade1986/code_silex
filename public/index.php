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
use Andrade\Sistema\Service\ProductService;
use Andrade\Sistema\Entity\Product;
use Andrade\Sistema\Mapper\ProductMapper;
use Symfony\Component\HttpFoundation\Request;

/* BASEADO NA BIBLIOTECA PIMPPLE QUE E UM SERVICE CONTAINER
REGISTRANDO UMA FUNCAO NO clienteService PARA TIRAR DO RESPONSE */
$app['clienteService'] = function (){
    $clienteEntity = new Cliente();
    $clienteMapper = new ClienteMapper();
    $clienteService = new ClienteService($clienteEntity,$clienteMapper);
    return $clienteService;
};

/* BASEADO NA BIBLIOTECA PIMPPLE QUE E UM SERVICE CONTAINER
REGISTRANDO UMA FUNCAO NO clienteService PARA TIRAR DO RESPONSE */
$app['productService'] = function (){
    $productEntity = new Product();
    $productMapper = new ProductMapper();
    $productService = new ProductService($productEntity,$productMapper);
    return $productService;
};

/*
GET /api/clientes - listar todos os clientes
GET /api/clientes/3 - listar apenas 1 cliente passando o id como parametro
POST /api/clientes - Insere novo cliente
PUT /api/clientes/2 - Altera um cliente passando o id como parametro
DELETE /apli/clientes/3 - Deleta um cliente passando o id como parametro
*/

#-------------------------------------------------------Product
/*Inserindo Produto*/
$app->post("/api/produtos",function(Request $request) use ($app){
    $dados['nome'] = $request->get('nome');
    $dados['descricao'] = $request->get('descricao');
    $dados['valor'] = $request->get('valor');
    $result = $app['productService']->insert($dados);
    return $app->json($result);
});

/*Listando todos os produtos*/
$app->get("/api/produtos",function() use ($app) {
    $dados = $app['productService']->fetchAll();
    return $app->json($dados);
});

/*Listando um produtos*/
$app->get("/api/produtos/{id}",function($id) use ($app) {
    $dados = $app['productService']->find($id);
    return $app->json($dados);
});

/*Deletando um produto  */
$app->delete("/api/produtos/{id}",function($id) use ($app) {
    if ((int) $id) {
        $dados = $app['productService']->delete($id);
        return $app->json($dados);
    }
    return false;

});

/*Alterando um Produto*/
$app->put("/api/produtos/{id}",function($id,Request $request) use ($app) {
    if ((int)$id){
        $dados['nome'] = $request->get('nome');
        $dados['descricao'] = $request->get('descricao');
        $dados['valor'] = $request->get('valor');
        $result = $app['productService']->update($id, $dados);
        return $app->json($result);
    }
    return false;
    });

#-------------------------------------------------------Cliente
/*Listando todos os clientes*/
$app->get("/api/clientes",function() use ($app) {
    $dados = $app['clienteService']->fetchAll();
    return $app->json($dados);
});

/*Listando todos os clientes*/
$app->get("/api/clientes/{id}",function($id) use ($app) {
    $dados = $app['clienteService']->find($id);
    return $app->json($dados);
});

/*Inserido um cliente com o post */
/*Usando o request para pegar os dados enviados via post*/
$app->post("/api/clientes",function(Request $request) use ($app) {
    $dados['nome'] = $request->get('nome');
    $dados['email'] = $request->get('email');
    $result = $app['clienteService']->insert($dados);

    return $app->json($result);
});

/*Alterando um cliente com o put */
/*Usando o request para pegar os dados enviados via put*/
$app->put("/api/clientes/{id}",function($id, Request $request) use ($app) {
    $data['nome'] = $request->request->get('nome');
    $data['email'] = $request->request->get('email');
    $result = $app['clienteService']->update($id,$data);

    return $app->json($result);
});
/*Deletando um cliente com o delete */
$app->delete("/api/clientes/{id}",function($id) use ($app) {
    $dados = $app['clienteService']->delete($id);
    return $app->json($dados);
});

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

$app->get("/contato",function() use($app){

    /*aqui o silex aguarda um response
    ou seja responder o request*/

    return $app['twig']->render('contato.twig',[]);

});

$app->put("/contato",function(Request $request) use($app){
    $dados['nome'] = $request->get('nome');
    return $app->json($dados);

});

/*pegando por parametros*/

$app->get("/clientes",function() use ($app){
    /*Listando os dados
    usando os meu serviços e o servico do twig
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