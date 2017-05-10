<?php

$serviceContainer = new \SONFin\ServiceContainer();
$app = new \SONFin\Application($serviceContainer);

$app->plugin(new \SONFin\Plugins\DbPlugin());
$app->plugin(new \SONFin\Plugins\AuthPlugin());

return $app;