<?php

namespace Src\Domain\Repositories;

use Src\Domain\Entities\{PasswordResetToken};
use Src\Domain\ValueObjects\Email;

interface PasswordResetTokenRepositoryInterface
{
    public function findByToken(string $token): ?PasswordResetToken;
    public function create(Email $email, string $token): PasswordResetToken;
}
