<?php

namespace Src\Application\UseCases\User\UpdateUser;

use DateTime;
use Src\Domain\ValueObjects\{Email, Uuid};

final readonly class UpdateUserOutputBoundary
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public Email $email,
        public string $username,
        public DateTime $createdAt,
        public ?string $picture = null,
        public ?DateTime $updatedAt = null,
    ) {}
}
