<?php

namespace Src\Domain\Repositories;

use Src\Domain\Entities\{EmailUpdateToken};
use Src\Domain\ValueObjects\Email;

interface EmailUpdateTokenRepositoryInterface
{
    public function findByToken(string $token): ?EmailUpdateToken;
    public function existByToken(string $token): bool;
    public function create(Email $email, string $token): EmailUpdateToken;
    public function deleteByToken(string $token): bool;
}
