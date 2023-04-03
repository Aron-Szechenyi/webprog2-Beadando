<?php

declare(strict_types=1);

namespace App\Controllers;

use Util\Routing\Route;

class HomeController extends BaseController
{
    #[Route('/')]
    public function index(): void
    {
        $this->render('index');
    }
}
