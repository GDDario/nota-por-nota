<?php

namespace Src\Domain\Services;

use Src\Application\DTOs\TokensDTO;
use Src\Application\Exceptions\InvalidRefreshTokenException;
use Src\Domain\Entities\User;

interface AuthenticationServiceInterface
{
    public function login(array $credentials): TokensDTO;

    public function logout(): void;

    public function getAuthenticatedUser(): User;

    /** @throws InvalidRefreshTokenException */
    public function refreshAccessToken(string $refreshToken): TokensDTO;
}
