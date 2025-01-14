<?php

namespace Src\Application\UseCases\User\UpdateUser;

use Src\Domain\ValueObjects\Email;

final readonly class UpdateUserInputBoundary
{
    public function __construct(
        public Email   $email,
        public ?string $name     = null,
        public ?string $username = null,
    )
    {
    }
}
