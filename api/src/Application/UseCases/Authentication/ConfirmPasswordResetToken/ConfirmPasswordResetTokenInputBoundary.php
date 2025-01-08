<?php

namespace Src\Application\UseCases\Authentication\ConfirmPasswordResetToken;

final readonly class ConfirmPasswordResetTokenInputBoundary
{
    public function __construct(
        public string $token
    ) {
    }
}
