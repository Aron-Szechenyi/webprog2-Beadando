<?php
/*
 * App's entry point
 */
declare(strict_types=1);

use App\Controllers\AdminController;
use App\Controllers\AuthenticationController;
use App\Controllers\HomeController;
use App\Controllers\OrderController;
use Util\Routing\Router;

include_once "vendor/autoload.php";

session_start();
if (!isset($_SESSION['logged'])) {
    $_SESSION['logged'] = false;
    $_SESSION['isAdmin'] = false;
}

$router = new Router();
$router->registerControllers(
    [
        HomeController::class,
        OrderController::class,
        AuthenticationController::class,
        AdminController::class
    ]
);

$router->resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

