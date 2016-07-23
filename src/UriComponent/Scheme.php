<?php

namespace MartiAdrogue\Http\UriComponent;

class Scheme extends Context
{
    protected function filter($value)
    {
        $scheme = strtolower($value);

        return rtrim($scheme, ':/');
    }
}
