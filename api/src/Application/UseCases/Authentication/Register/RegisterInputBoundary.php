<?php

namespace Src\Application\UseCases\Authentication\Register;

use Src\Domain\ValueObjects\Email;

final class RegisterInputBoundary
{
    public function __construct(
        public string $name,
        public Email  $email,
        public string $username,
        public string $password,
        public string $passwordConfirmation
    )
    {
    }
}
