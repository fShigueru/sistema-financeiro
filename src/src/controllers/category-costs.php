<?php

use SONFin\Models\CategoryCost;
use Psr\Http\Message\ServerRequestInterface;

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
    }, 'category-costs.store')
    ->get('/category-costs/{id}/edit', function (ServerRequestInterface $request) use ($app) {
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $category = CategoryCost::findOrFail($id);
        return $view->render('category-costs/edit.html.twig', ['category' => $category]);
    }, 'category-costs.edit')
    ->post('/category-costs/{id}/update', function (ServerRequestInterface $request) use ($app) {
        $id = $request->getAttribute('id');
        $category = CategoryCost::find($id);
        $data = $request->getParsedBody();
        $category->fill($data);
        $category->save();
        return $app->route('category-costs.list');
    }, 'category-costs.update')
    ->get('/category-costs/{id}/show', function (ServerRequestInterface $request) use ($app) {
        $view = $app->service('view.renderer');
        $id = $request->getAttribute('id');
        $category = CategoryCost::findOrFail($id);
        return $view->render('category-costs/show.html.twig', ['category' => $category]);
    }, 'category-costs.show')
    ->get('/category-costs/{id}/delete', function (ServerRequestInterface $request) use ($app) {
        $id = $request->getAttribute('id');
        $category = CategoryCost::findOrFail($id);
        $category->delete();
        return $app->route('category-costs.list');
    }, 'category-costs.delete')
;

$app->start();