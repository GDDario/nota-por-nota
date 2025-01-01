<?php

namespace Src\Application\UseCases\Authentication\Logout;

use Src\Domain\Services\AuthenticationServiceInterface;

final class LogoutUseCase
{
    public function __construct(
        private readonly AuthenticationServiceInterface $authenticationService
    )
    {
    }

    public function handle(): void
    {
        $this->authenticationService->logout();
    }
}
