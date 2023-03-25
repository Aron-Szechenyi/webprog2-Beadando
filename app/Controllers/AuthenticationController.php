<?php

declare(strict_types=1);

namespace App\Controllers;

use Util\Controller\BaseController;
use Util\Routeing\Route;

class AuthenticationController extends BaseController

{
    public function __construct()
    {

    }

    #[Route('/login')]
    public function index() :void
    {
       $this->render('authentication', []);
    }

    #[Route('/login','POST')]
    public function postTest(array $params):void
    {
        print "<h1>POST EXECUTED</h1>";
        print_r($params);
        $this->render('authentication.html', []);
    }





}
