<?php

namespace Src\Domain\Repositories;

use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Entities\User;
use Src\Domain\ValueObjects\Email;

interface UserRepositoryInterface
{
    public function findByEmail(Email $email): ?User;
    public function create(CreateUserDTO $dto): User;
}
