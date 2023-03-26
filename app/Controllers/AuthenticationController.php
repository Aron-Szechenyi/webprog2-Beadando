<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Util\Controller\BaseController;
use Util\Routeing\Route;

class AuthenticationController extends BaseController

{
    private User $user;

    public function __construct()
    {

    }

    #[Route('/register', 'POST')]
    public function registerPost(array $params): void
    {
        $this->render('authentication', []);
    }

    #[Route('/login', 'POST')]
    public function loginPost(array $params): void
    {
        $this->user = new User($params['username'], $params['password']);
        if ($this->user->login($params))
            $this->render('authentication', ['method' => 'Successful login'], ['login' => true]);
        else
            $this->render('authentication', ['method' => 'Incorrect Username or Password'], ['login' => true]);
    }

    #[Route('/login')]
    public function login(): void
    {
        $this->render('authentication', ['method' => 'Login'], ['login' => true]);
    }

    #[Route('/register')]
    public function register(): void
    {
        $this->render('authentication', ['method' => 'Register'], ['login' => false]);
    }
}
