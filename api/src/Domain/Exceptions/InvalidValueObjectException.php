<?php

namespace Src\Domain\Exceptions;

use Exception;

class InvalidValueObjectException extends Exception
{
    protected $message = 'Invalid value provided';

    public function __construct($message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
