<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\User;
use Util\Routing\Route;

class AuthenticationController extends BaseController
{
    private User $user;

    #[Route('/register', 'POST')]
    public function registerPost(array $params): void
    {
        $this->user = new User($params['username'], $params['password'], $params['email']);
        if ($this->user->register())
            $this->render('authentication', ['method' => 'Successful registration'], ['login' => false]);
        else
            $this->render('authentication', ['method' => 'This username is already in use'], ['login' => false]);
    }

    #[Route('/register')]
    public function register(): void
    {
        $this->render('authentication', ['method' => 'Register'], ['login' => false]);
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

    #[Route('/logout', 'POST')]
    public function logout(array $params): void
    {
        setcookie(session_id(), "", time() - 3600);
        session_destroy();
        session_write_close();

        $this->redirectToUrl('/');
    }
}
