<?php

namespace Src\Domain\Entities;

use DateTime;
use Src\Domain\ValueObjects\{Email};

final class PasswordResetToken
{
    public function __construct(
        public string   $token,
        public Email    $email,
        public DateTime $expiresAt,
        public DateTime $createdAt
    ) {
    }

    public function isExpired(): bool
    {
        return $this->expiresAt < now();
    }
}
