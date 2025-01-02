<?php

namespace Src\Domain\Exceptions;

use Exception;

class DomainException extends Exception
{
    protected $message;

    public function __construct($message = '')
    {
        parent::__construct($message);
    }
}
