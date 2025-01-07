<?php

namespace Src\Domain\Entities;

use DateTime;
use Src\Domain\Exceptions\DomainException;
use Src\Domain\ValueObjects\{Email, Uuid};

final class PasswordResetToken
{
    public function __construct(
        public string $token,
        public Email $email,
        public DateTime $expiresAt,
        public DateTime $createdAt
    ) {
    }
}
