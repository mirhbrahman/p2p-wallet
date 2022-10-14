<?php

namespace App\Exceptions;

use Exception;

class OwnAccountException extends Exception
{
    public function __construct(string $message="Can not transfer money to own account!")
    {
        parent::__construct($message, 422);
    }
}
