<?php

namespace Src\Application\UseCases\Authentication\ConfirmPasswordResetToken;

final class ConfirmPasswordResetTokenInputBoundary
{
    public function __construct(
        public string $token
    )
    {

    }
}
