<?php

namespace Src\Domain\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    protected $message = 'Authentication failed';

    public function __construct($message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
