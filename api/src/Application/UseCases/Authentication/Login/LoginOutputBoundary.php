<?php

namespace Src\Application\UseCases\Authentication\Login;

use DateTime;
use Src\Application\DTOs\TokensDTO;
use Src\Domain\ValueObjects\{Email, Uuid};

final class LoginOutputBoundary
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public Email $email,
        public string $username,
        public DateTime $createdAt,
        public TokensDTO $tokenData,
        public ?DateTime $updatedAt = null,
    ) {
    }
}
