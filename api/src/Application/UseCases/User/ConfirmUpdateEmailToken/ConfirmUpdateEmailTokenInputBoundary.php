<?php

namespace Src\Application\UseCases\User\ConfirmUpdateEmailToken;

final readonly class ConfirmUpdateEmailTokenInputBoundary
{
    public function __construct(
        public string $token
    )
    {
    }
}
