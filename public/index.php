<?php

require_once __DIR__ . '/../vendor/autoload.php';

session_start();

const STORAGE_PATH = __DIR__ . '/../storage';

$router = new App\Router();


$router
    ->get('/', [\App\Controllers\HomeController::class, 'index'])
    ->post('/upload', [\App\Controllers\HomeController::class, 'upload'])
    ->get('/invoices', [\App\Controllers\InvoiceController::class, 'index'])
    ->get('/invoices/create', [\App\Controllers\InvoiceController::class, 'create'])
    ->post('/invoices/create', [\App\Controllers\InvoiceController::class, 'store']);


echo $router->resolve(
    $_SERVER['REQUEST_URI'],
    strtolower($_SERVER['REQUEST_METHOD'])
);

//phpinfo();

