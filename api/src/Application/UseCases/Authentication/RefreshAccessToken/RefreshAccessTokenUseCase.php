<?php

namespace Src\Application\UseCases\Authentication\RefreshAccessToken;

use Src\Domain\Services\AuthenticationServiceInterface;

final class RefreshAccessTokenUseCase
{
    public function __construct(
        private AuthenticationServiceInterface $authenticationService
    )
    {

    }

    public function handle(RefreshTokenInputBoundary $input): RefreshTokenOutputBoundary
    {
        $tokensDTO = $this->authenticationService->refreshAccessToken(
            $input->refreshToken
        );

        return new RefreshTokenOutputBoundary(
            $tokensDTO
        );
    }
}
