<?php

namespace App\Exception;

use Throwable;

class DatabaseCreateException extends \Exception
{
    public function __construct($message, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}