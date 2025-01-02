<?php

namespace Src\Domain\Exceptions;

final class InvalidEmailException extends InvalidValueObjectException
{
    protected $message = 'Invalid email provided.';

    public function __construct($message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
