<?php

namespace MartiAdrogue\Http\Exception;

use Exception;
use InvalidArgumentException;

class InvalidPortException extends InvalidArgumentException
{
    public function __construct($port, Exception $previous = null)
    {
        $message = sprintf('Invalid port: %d. Must be between 1 and 65535.', $port);
        parent::__construct($message, 2, $previous);
    }
}
