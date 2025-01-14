<?php

namespace Src\Domain\Repositories;

use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Entities\User;
use Src\Domain\ValueObjects\Email;

interface UserRepositoryInterface
{
    public function findByEmail(Email $email): ?User;
    public function create(CreateUserDTO $dto): User;
    public function update(Email $email, ?string $name, ?string $username): ?User;
    public function updatePassword(Email $email, string $password): ?User;
    public function updateEmail(Email $oldEmail, Email $newEmail): ?User;
    public function updatePicture(Email $email, string $picture, string $originalPicture): ?User;

}
