<?php
require_once '../vendor/autoload.php';

use App\Libraries\Routing;

use App\Controllers\ProductCategoryController;

$routing = new Routing();

// Definition route in home page
$routing->add('GET', '/', function () {
    include 'View/home.php';
});

// Definition route in about page
$routing->add('GET', '/about', function () {
    include 'View/about.php';
});

// Definition route in contact page
$routing->add('GET', '/contact', function () {
    include 'View/contact.php';
});

// Definition route in product-category page
$routing->add('GET', '/product-category', function () {
    include 'View/crud.php';
});

$routing->add('GET',  '/product-category',            [ProductCategoryController::class, 'index']);
$routing->add('POST', '/product-category/store',      [ProductCategoryController::class, 'store']);
$routing->add('GET',  '/product-category/:id',        [ProductCategoryController::class, 'show']);
$routing->add('POST', '/product-category/update/:id', [ProductCategoryController::class, 'update']);
$routing->add('POST', '/product-category/delete/:id', [ProductCategoryController::class, 'delete']);

// Run routing
$routing->run();

?>