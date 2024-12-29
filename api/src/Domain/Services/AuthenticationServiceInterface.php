<?php

namespace Src\Domain\Services;

use Src\Application\DTOs\LoginDataDTO;

interface AuthenticationServiceInterface
{
    public function login(array $credentials): LoginDataDTO;
}
