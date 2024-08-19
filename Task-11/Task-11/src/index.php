<?php

require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\ProductCategoryController;
use App\Libraries\Database;
use App\Libraries\Routing;

$database = new Database();
$router = new Routing();

// Home page route
$router->add('GET', '/', function () {
    require 'crud.php';
});

$router->add('GET',  '/product-category',     [ProductCategoryController::class, 'index']);
$router->add('GET',  '/product-category/:id', [ProductCategoryController::class, 'show']);
$router->add('POST', '/product-category',     [ProductCategoryController::class, 'store']);
$router->add('POST', '/product-category/:id', [ProductCategoryController::class, 'update']);
$router->add('GET',  '/product-category/:id', [ProductCategoryController::class, 'delete']);

// Run the router
echo $router->run();