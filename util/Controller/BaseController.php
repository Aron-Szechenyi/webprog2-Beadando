<?php

declare(strict_types=1);

namespace Util\Controller;

use Util\View\View;

class BaseController
{
    public function render(string $view_name, array $params = [],array $booleans = []): void
    {
        $view = new View();
        $view->render($view_name, $params,$booleans);
    }
}