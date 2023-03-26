<?php

declare(strict_types=1);

namespace Util\Routeing;

use ReflectionAttribute;
use ReflectionClass;

class Router
{
    private array $routes = [];

    public function __construct()
    {
    }

    public function registerControllers(array $controllers): void
    {
        foreach ($controllers as $controller) {
            if (!class_exists($controller))
                break;

            $reflectionController = new ReflectionClass($controller);

            foreach ($reflectionController->getMethods() as $method) {
                $attributes = $method->getAttributes(Route::class, ReflectionAttribute::IS_INSTANCEOF);

                foreach ($attributes as $attribute) {
                    $route = $attribute->newInstance();
                    $this->register($route->method, $route->routePath, [$controller, $method->getName()]);
                }
            }
        }
    }

    private function register(string $requestMethod, string $route, callable|array $action): void
    {
        $this->routes[$requestMethod][$route] = $action;
    }

    public function resolve(string $requestUri, string $requestMethod): void
    {
        $cleanRoute = explode('?', $requestUri)[0];

        foreach ($this->routes as $key => $route) {
            foreach ($route as $k => $r) {

                [$controller, $method] = $r;

                if ($k === $cleanRoute && $requestMethod === $key && class_exists($controller)) {

                    echo 'debug in Router.php:<br>';
                    if (!empty($_REQUEST))
                        print_r($_REQUEST);
                    echo '<br>';

                    $reflectionClass = new ReflectionClass($controller);
                    $instance = $reflectionClass->newInstance();
                    call_user_func_array([$instance, $method], array($_REQUEST));
                    exit();
                }
            }
        }
        header("HTTP/1.0 404 Not Found");
    }
}
