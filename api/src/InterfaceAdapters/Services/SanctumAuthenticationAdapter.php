<?php

namespace Src\InterfaceAdapters\Services;

use Illuminate\Support\Facades\Auth;
use Src\Application\DTOs\LoginDataDTO;
use Src\Domain\Exceptions\AuthenticationException;
use Src\Domain\Services\AuthenticationServiceInterface;

final class SanctumAuthenticationAdapter implements AuthenticationServiceInterface
{
    /**
     * @throws AuthenticationException
     */
    public function login(array $credentials): LoginDataDTO
    {
        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException();
        }


        $user = Auth::user();
        $expirationDate = now()->addMinutes((int)env('SANCTUM_EXPIRATION_TIME', 60));

        $token = $user->createToken('auth_token');
        $accessToken = $token->plainTextToken;

        $token->accessToken->forceFill([
            'expires_at' => $expirationDate,
        ])->save();

        $refreshToken = bin2hex(random_bytes(40));

        $user->refreshTokens()->create([
            'token' => hash('sha256', $refreshToken),
            'expires_at' => $expirationDate,
            'created_at' => now()
        ]);

        return new LoginDataDTO(
            accessToken: $accessToken,
            refreshToken: $refreshToken,
            expiresAt: $expirationDate->toDateTime()
        );
    }
}
