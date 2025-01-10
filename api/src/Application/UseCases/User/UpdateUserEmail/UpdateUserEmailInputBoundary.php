<?php

namespace Src\Application\UseCases\User\UpdateUserEmail;

use Src\Domain\ValueObjects\Email;

final readonly class UpdateUserEmailInputBoundary
{
    public function __construct(
        public string $token,
        public Email  $email,
        public Email  $emailConfirmation,
    )
    {
    }
}
