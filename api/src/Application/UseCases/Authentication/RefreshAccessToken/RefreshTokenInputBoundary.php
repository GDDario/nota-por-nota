<?php

namespace Src\Application\UseCases\Authentication\RefreshAccessToken;

final class RefreshTokenInputBoundary
{
    public function __construct(
        public readonly string $refreshToken
    ) {

    }
}
