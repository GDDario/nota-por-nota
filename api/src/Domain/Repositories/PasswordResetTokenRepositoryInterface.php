<?php

namespace Src\Domain\Repositories;

use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Entities\User;
use Src\Domain\ValueObjects\Email;

interface PasswordResetTokenRepositoryInterface
{
    public function create(Email $email, string $token): void;
}
