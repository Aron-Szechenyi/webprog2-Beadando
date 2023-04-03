<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pizza;
use ReflectionClass;
use Util\Routing\Route;

class OrderController extends BaseController
{
    #[Route('/menu')]
    public function index(): void
    {
        $pizza = new ReflectionClass(Pizza::class);
        $pizzas = $pizza->newInstanceWithoutConstructor()->getAllPizza();
        $cards = "";
        foreach ($pizzas as $key => $value) {
            $cards .= $this->assembleCards($value);
        }
        $this->render('menu', ["cards" => $cards]);
    }

    private function assembleCards($value): string
    {
        return '<div class="col-md-4">
            <div class="card"">
                <img class="card-img-top" src="img/' . $value["PICTURE"] . '">
                <div class="card-body">
                    <h5 class="card-title">' . $value["NAME"] . '</h5>
                    <h6 class="card-subtitle mb-2 text-muted">' . $value["PRICE"] . ' HUF</h6>
                    <p class="card-text">' . $value["DESCRIPTION"] . '</p>
                    <form action="/menu" method="POST">
                         <input type="hidden" id="id" name="id" value="' . $value["ID"] . '">
                         <input type="hidden" id="name" name="name" value="' . $value["NAME"] . '">
                         <button class="card-button" type="Submit" value="submit">
                             Buy!
                         </button>
                    </form>
                </div>
            </div>
        </div>';
    }

    #[Route('/menu', 'POST')]
    public function postTest(array $params): void
    {
        $pizza = new ReflectionClass(Pizza::class);
        $pizzas = $pizza->newInstanceWithoutConstructor()->getAllPizza();
        $cards = "";
        foreach ($pizzas as $key => $value) {
            $cards .= $this->assembleCards($value);
        }
        $this->render('menu', ["cards" => $cards]);
    }
}
