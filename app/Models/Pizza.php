<?php

declare(strict_types=1);

namespace App\Models;

use Util\DbManager\BaseModel;

class Pizza extends BaseModel
{
    private int $id;
    private string $name;
    private string $description;
    private string $picture;
    private int $price;


    public function __construct(string $name, string $description, int $price, string $picture = 'pizza.png', int|null $id = null)
    {
        $this->name = $name;
        $this->price = $price;
        $this->picture = $picture;
        $this->description = $description;

        if (!empty($id))
            $this->id = $id;
    }

    public function addNewPizza(): bool
    {
        $this->id = $this->Create();
        if (!empty($this->id))
            return true;
        return false;
    }

    public function getAllPizza(): array
    {
        return $this->getAll();
    }
}