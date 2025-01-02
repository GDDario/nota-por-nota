<?php

namespace Src\Application\UseCases\Authentication\GetAuthenticatedUser;

use DateTime;
use Src\Domain\ValueObjects\{Email, Uuid};

final class GetAuthenticatedUserOutputBoundary
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public Email $email,
        public string $username,
        public DateTime $createdAt,
        public ?DateTime $updatedAt = null
    ) {
    }
}
