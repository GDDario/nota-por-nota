<?php

namespace Src\Application\Exceptions;

use Exception;

final class InvalidRefreshTokenException extends Exception
{
    protected $message = 'Invalid refresh token provided.';

    public function __construct($message = null)
    {
        parent::__construct($message ?? $this->message);
    }
}
