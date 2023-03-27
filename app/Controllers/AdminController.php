<?php

declare(strict_types=1);

namespace App\Controllers;

use Util\Routeing\Route;

class AdminController extends BaseController

{
    public function __construct()
    {

    }

    #[Route('/editMenu')]
    public function index(): void
    {
        $this->render('editMenu');
    }

    #[Route('/editMenu', 'POST')]
    public function postTest(array $params): void
    {
        print "<h1>POST EXECUTED</h1>";
        print_r($params);
        $this->render('editMenu');
    }
}
