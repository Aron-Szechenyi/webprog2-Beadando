<?php

declare(strict_types=1);

namespace App\Controllers;

use Util\View\View;

class BaseController
{
    public function render(string $view_name, array $params = [], array $booleans = []): void
    {
        $booleans += ['logged' => $_SESSION['logged']];
        $booleans += ['isAdmin' => $_SESSION['isAdmin']];
        $view = new View();
        $view->render($view_name, $params, $booleans);
    }

    public function redirectToUrl(string $url): void
    {
        header("Location: $url");
    }
}