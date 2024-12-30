<?php

namespace Src\Domain\Exceptions;

use Exception;

class AuthenticationException extends Exception
{
    protected $message = 'Invalid credentials provided.';

    public function __construct($message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
