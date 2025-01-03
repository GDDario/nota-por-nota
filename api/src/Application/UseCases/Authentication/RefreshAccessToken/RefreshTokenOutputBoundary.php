<?php

namespace Src\Application\UseCases\Authentication\RefreshAccessToken;

use Src\Application\DTOs\TokensDTO;

final class RefreshTokenOutputBoundary
{
    public function __construct(
        public readonly TokensDTO $tokensDTO
    )
    {

    }
}
