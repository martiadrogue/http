<?php

namespace MartiAdrogue\Http\Component\Uri;

class Scheme extends Context
{
    protected function filter($value)
    {
        $scheme = strtolower($value);

        return rtrim($scheme, ':/');
    }
}
