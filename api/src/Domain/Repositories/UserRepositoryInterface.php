<?php

namespace Src\Domain\Repositories;

use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Entities\User;

interface UserRepositoryInterface
{
    public function create(CreateUserDTO $dto): User;
}
