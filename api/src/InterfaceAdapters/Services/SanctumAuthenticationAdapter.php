<?php

namespace Src\InterfaceAdapters\Services;

use Illuminate\Support\Facades\Auth;
use Random\RandomException;
use Src\Application\DTOs\TokensDTO;
use Src\Domain\Entities\User;
use Src\Domain\Exceptions\AuthenticationException;
use Src\Domain\Services\AuthenticationServiceInterface;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

final class SanctumAuthenticationAdapter implements AuthenticationServiceInterface
{
    /**
     * @throws AuthenticationException
     * @throws RandomException
     */
    public function login(array $credentials): TokensDTO
    {
        if (! Auth::attempt($credentials)) {
            throw new AuthenticationException;
        }

        $user = Auth::user();
        $expirationDate = now()->addMinutes((int) config('SANCTUM_EXPIRATION_TIME', 60));

        $token = $user->createToken('access_token');
        $accessToken = $token->plainTextToken;

        $token->accessToken->forceFill([
            'expires_at' => $expirationDate,
        ])->save();

        $refreshToken = bin2hex(random_bytes(40));

        $user->refreshTokens()->create([
            'token' => hash('sha256', $refreshToken),
            'expires_at' => $expirationDate,
            'created_at' => now(),
        ]);

        return new TokensDTO(
            accessToken: $accessToken,
            refreshToken: $refreshToken,
            expiresAt: $expirationDate->toDateTime()
        );
    }

    public function logout(): void
    {
        $user = Auth::user();
        $user->currentAccessToken()->delete();
        $user->refreshTokens()->delete();
    }

    public function getAuthenticatedUser(): User
    {
        $user = Auth::user();

        return new User(
            id: $user['id'],
            uuid: new Uuid($user['uuid']),
            name: $user['name'],
            email: new Email($user['email']),
            username: $user['username'],
            createdAt: $user['created_at'],
            updatedAt: $user['updated_at']
        );
    }
}
