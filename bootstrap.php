<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 17/03/16
 * Time: 10:40
 */

require_once 'vendor/autoload.php';

//instaciando a classe silex
$app = new \Silex\Application();

// para mostrar os erros que estao acontecendo
$app['debug'] = true;


// REGISTRANDO O TWIG NO SILEX PARA ELE FAZER AS CONFIGURAÇÔES
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

//REGISTRANDO O SERVICO DE URL
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());