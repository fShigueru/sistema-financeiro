<?php

use SONFin\Application;
use SONFin\Models\CategoryCost;
use SONFin\Plugins\DbPlugin;
use SONFin\Plugins\ViewPlugin;
use SONFin\ServiceContainer;
use SONFin\Plugins\RoutePlugin;
use Psr\Http\Message\ServerRequestInterface;

require_once __DIR__ . '/../vendor/autoload.php';

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new RoutePlugin());
$app->plugin(new ViewPlugin());
$app->plugin(new DbPlugin());

$app->get('/home/{name}', function (ServerRequestInterface $request){
    $response = new \Zend\Diactoros\Response();
    $response->getBody()->write("reponse com emitter");
    return $response;
});

$app
    ->get('/category-costs', function () use ($app) {
        $view = $app->service('view.renderer');
        $model = new CategoryCost();
        $categories = $model->all();
        return $view->render('category-costs/list.html.twig', ['categories' => $categories]);
    }, 'category-costs.list')
    ->get('/category-costs/new', function () use ($app) {
        $view = $app->service('view.renderer');
        return $view->render('category-costs/create.html.twig');
    }, 'category-costs.new')
    ->post('/category-costs/store', function (ServerRequestInterface $request) use($app) {
        //cadastra categoria
        $data = $request->getParsedBody();
        CategoryCost::create($data);
        return $app->route('category-costs.list');
    }, 'category-costs.store');

$app->start();