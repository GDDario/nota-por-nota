<?php

namespace Src\Domain\Services;

use Src\Application\DTOs\TokensDTO;

interface AuthenticationServiceInterface
{
    public function login(array $credentials): TokensDTO;

    public function logout(): void;
}
