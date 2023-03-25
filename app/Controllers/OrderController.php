<?php

declare(strict_types=1);

namespace App\Controllers;

use Util\Controller\BaseController;
use Util\Routeing\Route;

class OrderController extends BaseController

{
    public function __construct()
    {

    }

    #[Route('/menu')]
    public function index() :void
    {
       $this->render('menu',[],['logged_in'=>false]);
    }

    #[Route('/menu','POST')]
    public function postTest(array $params):void
    {
        print "<h1>POST EXECUTED</h1>";
        print_r($params);
        $this->render('index');
    }
}
