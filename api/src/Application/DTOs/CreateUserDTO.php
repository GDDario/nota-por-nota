<?php

namespace Src\Application\DTOs;

use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

final class CreateUserDTO
{
    public function __construct(
        public Uuid $uuid,
        public string $name,
        public Email $email,
        public string $username,
        public string $password
    ) {}
}
