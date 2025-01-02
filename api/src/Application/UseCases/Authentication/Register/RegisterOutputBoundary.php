<?php

namespace Src\Application\UseCases\Authentication\Register;

use DateTime;
use Src\Application\DTOs\TokensDTO;
use Src\Domain\ValueObjects\{Email, Uuid};

final class RegisterOutputBoundary
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public Email $email,
        public string $username,
        public DateTime $createdAt,
        public TokensDTO $tokenData
    ) {
    }
}
