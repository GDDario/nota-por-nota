<?php

namespace Src\Application\UseCases\Authenticaction\Register;
use DateTime;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

final class RegisterOutputBoundary
{
    public function __construct(
        public Uuid     $uuid,
        public string   $name,
        public Email    $email,
        public string   $username,
        public DateTime $createdAt,
        public string   $accessToken,
        public string   $refreshToken,
        public DateTime $expiresAt
    )
    {
    }
}
