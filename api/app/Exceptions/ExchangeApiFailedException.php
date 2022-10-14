<?php

namespace App\Exceptions;

use Exception;

class ExchangeApiFailedException extends Exception
{
    public function __construct(string $message="Exchange Api failed!")
    {
        parent::__construct($message, 500);
    }
}
