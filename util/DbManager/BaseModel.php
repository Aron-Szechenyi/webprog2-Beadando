<?php

declare(strict_types=1);

namespace Util\DbManager;

class BaseModel
{
    protected function Save(): bool
    {
        $className = get_class($this);
        $params = $this->getParamsArray();
        return DB::getInstance()->update($className, $params['id'], $params);
    }

    private function getParamsArray(): array
    {
        /*
         * @TODO: rewrite this
         */

        $string = explode("array", var_export($this, true))[1];
        $string[strlen($string) - 1] = ' ';
        $string[strlen($string) - 4] = ' ';
        $string[0] = ' ';
        $string[strlen($string) - 2] = ' ';

        $string = explode(",", $string);
        $array = [];


        foreach ($string as $s) {
            $s = explode("=>", $s);
            $s[0] = trim(str_replace('\'', '', $s[0]));
            $s[1] = trim(str_replace('\'', '', $s[1]));

            $array[$s[0]] = $s[1];
        }

        return $array;
    }

    protected function Create(): int
    {
        $className = $this->getClassName();

        return (int)DB::getInstance()->insert($className, $this->getParamsArray());
    }

    private function getClassName(): string
    {
        $className = get_class($this);
        $className = explode('\\', $className);
        return end($className);
    }

    protected function getAll(): array
    {
        $array = [];
        $objects = DB::getInstance()->query("select * from {$this->getClassName()}")->results();
        foreach ($objects as $key => $value) {

            $array[] = json_decode(json_encode($value), true);
        }
        return $array;
    }
}