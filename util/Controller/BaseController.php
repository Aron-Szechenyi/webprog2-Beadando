<?php

declare(strict_types=1);

namespace Util\Controller;

use Util\View\View;

class BaseController
{
    public function render($view_name, $params = []): void
    {
        $view = new View();
        $view->render($view_name, $params);
    }
}