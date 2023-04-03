<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pizza;
use Util\Routing\Route;

class AdminController extends BaseController
{
    #[Route('/addNewItem')]
    public function index(): void
    {
        $this->render('addNewItem', ["method" => "Add new pizza to the menu"]);
    }

    #[Route('/addNewItem', 'POST')]
    public function postTest(array $params): void
    {
        $pizza = new Pizza($params['name'], $params['description'], (int)$params['price'], $params['picture']);
        $pizza->addNewPizza();
        $this->render('addNewItem', ["method" => $params['name'] . " successfully added to the menu"]);
    }
}
