<?php

namespace Src\Application\UseCases\Authentication\ResetPassword;

final readonly class ResetPasswordInputBoundary
{
    public function __construct(
        public string $token,
        public string $password,
        public string $passwordConfirmation
    ) {
    }
}
