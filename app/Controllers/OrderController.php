<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Pizza;
use ReflectionClass;
use Util\Routeing\Route;

class OrderController extends BaseController

{
    public function __construct()
    {

    }

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

    /*
     * no clue how to implement cycles in the templating lib
     */
    private function assembleCards($value): string
    {
        return ' <table class="container"><tr>
            <div id="' . $value["ID"] . '"> 
                   <td class="pizzaneve"> <h2>' . $value["NAME"] . ' </h2></td>
                   <td class="descript"> <p> ' . $value["DESCRIPTION"] . ' </p></td>
                   <td class="pizza">
                        <img id="kep" src="' . $value["PICTURE"] . '">
                        </td>
                 <td class="price"> <h2>' . $value["PRICE"] . ' </h2></td>
                 <td class="kosár">
                 <form action="pizzak.php" method="get">
                 <input type="hidden" id="id" name="id" value="' . $value["ID"] . '">
                 <input type="hidden" id="name" name="name" value="' . $value["NAME"] . '">
                 <button type="Submit" value="submit">
                     <img id="kep2" src="cart.png"/>
                 </button>
             </form>
                 </td>
               </div>
               </tr></table><br>';
    }

    #[Route('/menu', 'POST')]
    public function postTest(array $params): void
    {
        print "<h1>POST EXECUTED</h1>";
        print_r($params);
        $this->render('index');
    }
}
