<?php

use App\View;

require_once __DIR__ . '/../vendor/autoload.php';

//session_start();

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

const STORAGE_PATH = __DIR__ . '/../storage';
const VIEW_PATH = __DIR__ . '/../views';

$router = new App\Router();

try {
    $router
        ->get('/', [\App\Controllers\HomeController::class, 'index'])
        ->get('/download', [\App\Controllers\HomeController::class, 'download'])
        ->post('/upload', [\App\Controllers\HomeController::class, 'upload'])
        ->get('/invoices', [\App\Controllers\InvoiceController::class, 'index'])
        ->get('/invoices/create', [\App\Controllers\InvoiceController::class, 'create'])
        ->post('/invoices/create', [\App\Controllers\InvoiceController::class, 'store']);


    echo $router->resolve(
        $_SERVER['REQUEST_URI'],
        strtolower($_SERVER['REQUEST_METHOD'])
    );
} catch(\App\Exception\RouteNotFoundException $e) {
    http_response_code(404);
    echo View::make('error/404');
}

//phpinfo();

