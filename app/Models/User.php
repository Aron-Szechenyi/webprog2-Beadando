<?php

declare(strict_types=1);

namespace App\Models;

use Util\Crypto\Crypto;
use Util\DbManager\BaseModel;
use Util\DbManager\DB;

class User extends BaseModel
{
    private int $id;
    private string $userName;
    private string $password;
    private string $email;

    public function __construct(string $userName, string $password, string|null $email = null, int|null $id = null)
    {
        $this->userName = $userName;
        $this->password = $password;
        if (!empty($email))
            $this->email = $email;
        if (!empty($id))
            $this->id = $id;
    }

    public function register(): bool
    {
        if (DB::getInstance()->query('select count(*) c from user where username=? ', [$this->userName])->first()->c > 0) {
            return false;
        }

        $this->password = Crypto::SHA256($this->password);
        $this->id = $this->Create();

        if ($this->id == null)
            return false;

        return true;
    }

    public function login(array $params): bool
    {
        $params['password'] = Crypto::SHA256($params['password']);

        $tmp = DB::getInstance()->query('select count(*) c from user where username=? and password=?', $params)->first()->c;
        if ($tmp == 0)
            return false;

        $_SESSION['logged'] = true;
        $_SESSION['role'] = $this->getUserRole($params['username']);
        return true;
    }

    public function getUserRole(string $username): int
    {
        $role = (DB::getInstance()->query("select role from user where username=?", [$username])->first())->role;

        return match ($role) {
            'admin' => 0,
            'user' => 1,
            default => -1,
        };
    }
}