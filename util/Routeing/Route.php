<?php

declare(strict_types=1);

namespace Util\Routeing;

#[\Attribute]
class Route
{
    public function __construct(public string $routePath, public string $method = 'GET')
    {

    }
}