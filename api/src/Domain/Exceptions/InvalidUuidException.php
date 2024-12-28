<?php

namespace Src\Domain\Exceptions;

final class InvalidUuidException extends InvalidValueObjectException
{
    protected $message = 'Invalid Uuid format.';

    public function __construct($message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
