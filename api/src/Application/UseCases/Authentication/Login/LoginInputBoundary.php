<?php

namespace Src\Application\UseCases\Authentication\Login;

use Src\Domain\ValueObjects\Email;

final class LoginInputBoundary
{
    public function __construct(
        public Email $email,
        public string $password
    ) {}
}
