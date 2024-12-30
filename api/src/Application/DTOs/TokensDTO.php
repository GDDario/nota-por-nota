<?php

namespace Src\Application\DTOs;

use DateTime;

final class TokensDTO
{
    public function __construct(
        public string   $accessToken,
        public string   $refreshToken,
        public DateTime $expiresAt
    )
    {

    }
}
