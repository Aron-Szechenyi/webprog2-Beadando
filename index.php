<?php
/*
 * App's entry point
 */
declare(strict_types=1);

use App\Controllers\AuthenticationController;
use App\Controllers\HomeController;
use App\Controllers\OrderController;
use Util\Routeing\Router;

include_once "vendor/autoload.php";

$router = new Router();
$router->registerControllers(
    [
        HomeController::class,
        OrderController::class,
        AuthenticationController::class
    ]
);

$router->resolve($_SERVER['REQUEST_URI'],$_SERVER['REQUEST_METHOD']);

