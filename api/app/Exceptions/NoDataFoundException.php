<?php

namespace App\Exceptions;

use Exception;

class NoDataFoundException extends Exception
{
    public function __construct(string $message="No data found!")
    {
        parent::__construct($message, 404);
    }
}
