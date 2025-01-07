<?php

namespace Src\InterfaceAdapters\Services;

use App\Models\RefreshToken;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Random\RandomException;
use Src\Application\DTOs\TokensDTO;
use Src\Application\Exceptions\InvalidRefreshTokenException;
use Src\Domain\Entities\User;
use Src\Domain\Exceptions\AuthenticationException;
use Src\Domain\Services\AuthenticationServiceInterface;
use Src\Domain\ValueObjects\{Email, Uuid};

final class SanctumAuthenticationAdapter implements AuthenticationServiceInterface
{
    /**
     * @throws AuthenticationException
     * @throws RandomException
     */
    public function login(array $credentials): TokensDTO
    {
        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException();
        }

        $user = Auth::user();

        return $this->generateTokens($user);
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

    /**
     * @throws InvalidRefreshTokenException
     */
    public function refreshAccessToken(string $refreshToken): TokensDTO
    {
        $refreshTokenModel = RefreshToken::query()->where('token', $refreshToken)->firstOrFail();

        if (now() > $refreshTokenModel->expires_at) {
            throw new InvalidRefreshTokenException('The refresh token has expired. Please log in again.');
        }

        $userId = $refreshTokenModel->user_id;

        $user = Auth::loginUsingId($userId);

        return $this->generateTokens($user);
    }

    public function generateTokens(?Authenticatable $user): TokensDTO
    {
        $accessTokenExpirationDate  = now()->addMinutes((int)config('ACCESS_TOKEN_EXPIRATION_TIME', 60));
        $refreshTokenExpirationDate = now()->addMinutes((int)config('REFRESH_TOKEN_EXPIRATION_TIME', 43200));

        $token       = $user->createToken('access_token');
        $accessToken = $token->plainTextToken;

        $token->accessToken->forceFill([
            'expires_at' => $accessTokenExpirationDate,
        ])->save();

        $refreshToken = hash('sha256', bin2hex(random_bytes(40)));

        $user->refreshTokens()->create([
            'token'      => $refreshToken,
            'expires_at' => $refreshTokenExpirationDate,
            'created_at' => now(),
        ]);

        return new TokensDTO(
            accessToken: $accessToken,
            refreshToken: $refreshToken,
            expiresAt: $accessTokenExpirationDate->toDateTime()
        );
    }
}
