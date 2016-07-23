<?php

namespace MartiAdrogue\Http\Exception;

use Exception;
use InvalidArgumentException;

class InvalidUriException extends InvalidArgumentException
{
    public function __construct($uri, Exception $previous = null)
    {
        $message = "Unable to parse URI: $uri";
        parent::__construct($message, 1, $previous);
    }
}
