<?php

use SONFin\Application;
use SONFin\Plugins\ViewPlugin;
use SONFin\ServiceContainer;
use SONFin\Plugins\RoutePlugin;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());

$app->get('/{name}', function (ServerRequestInterface $request) use($app) {
    $view = $app->service('view.renderer');
    return $view->render('teste.html.twig', ['name' => $request->getAttribute('name')]);
});

$app->get('/home/{name}', function (ServerRequestInterface $request){
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write("reponse com emitter");
    return $response;
});

$app->start();