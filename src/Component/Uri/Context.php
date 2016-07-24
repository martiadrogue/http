<?php

namespace MartiAdrogue\Http\Component\Uri;

abstract class Context
{

    public function __construct($value)
    {
        $this->value = $this->filter($value);
    }

    abstract protected function filter($value);

    public function __toString()
    {
        return (string) $this->value;
    }
}
