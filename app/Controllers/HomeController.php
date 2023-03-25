<?php

declare(strict_types=1);

namespace App\Controllers;

use Util\Controller\BaseController;
use Util\Routeing\Route;

class HomeController extends BaseController

{
    public function __construct()
    {

    }

    #[Route('/')]
    public function index(): void
    {
        $this->render('index', []);
    }
}
