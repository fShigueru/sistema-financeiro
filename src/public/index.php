<?php

use SONFin\Application;
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

require_once  __DIR__ . '/../src/controllers/category-costs.php';
require_once  __DIR__ . '/../src/controllers/users.php';

$app->start();