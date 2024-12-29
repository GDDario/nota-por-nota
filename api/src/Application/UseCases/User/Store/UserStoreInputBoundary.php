<?php

namespace Src\Application\UseCases\User\Store;

use Src\Domain\ValueObjects\Email;

final class UserStoreInputBoundary
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
