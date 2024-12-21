<?php
require '../core/Cors.php';
use Core\Router;
use Middlewares\AuthMiddleware;
use Middlewares\RolePermissionMiddleware;
use App\Controllers\PrinterController;
use App\Controllers\PrintHistoryController;

$router = new Router();

// Public routes
$router->add('POST', '/login', 'AuthController@login');

// Protected routes
$router->add('POST', '/getPrinters', function () {
    AuthMiddleware::handle();
    (new RolePermissionMiddleware('printers', ['view']))->handle();
    (new App\Controllers\PrinterController())->getPrinters();
});

$router->add('POST', '/addPrinter', function () {
    AuthMiddleware::handle();
    (new RolePermissionMiddleware('printers', ['create']))->handle();
    (new App\Controllers\PrinterController())->addPrinter();
});

$router->add('POST', '/editPrinter', function () {
    AuthMiddleware::handle();
    (new RolePermissionMiddleware('printers', ['update']))->handle();
    (new App\Controllers\PrinterController())->editPrinter();
});


$router->add('POST', '/addPrintHistory', function () {
    AuthMiddleware::handle();
    (new RolePermissionMiddleware('print_history', ['create']))->handle();
    (new App\Controllers\PrintHistoryController())->addPrintHistory();
});

$router->add('POST', '/getPrintHistorys', function () {
    AuthMiddleware::handle();
    (new RolePermissionMiddleware('print_history', ['view','view_own']))->handle();
    (new App\Controllers\PrintHistoryController())->getPrintHistorys();
});
