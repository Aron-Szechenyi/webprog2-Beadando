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
    private string $email;
    private string $password;

    public function __construct(string $userName, string $password, string|null $email = null, int|null $id = null)
    {
        $this->userName = $userName;
        $this->password = $password;
        if (!empty($this->email))
            $this->email = $email;
        if (!empty($this->id))
            $this->id = $id;
    }

    public function register(): bool
    {
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
        if ($tmp > 0)
            return true;
        return false;
    }
}