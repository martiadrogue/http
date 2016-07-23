<?php

namespace MartiAdrogue\Http\UriComponent;

use MartiAdrogue\Http\Exception\InvalidPortException;

class Port extends Context
{
    protected function filter($value)
    {
        $port = (int) $value;

        if (1 > $port || 0xffff < $port) {
            throw new InvalidPortException($port);
        }

        return $port;
    }
}
