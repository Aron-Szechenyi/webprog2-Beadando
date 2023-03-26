<?php

declare(strict_types=1);

namespace Util\Crypto;

class Crypto
{
    public static function SHA256(string $string): string
    {
        return hash('sha256', $string);
    }
}