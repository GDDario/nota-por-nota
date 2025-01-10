<?php

namespace Src\Application\UseCases\Authentication\GetAuthenticatedUser;

use Src\Domain\Services\AuthenticationServiceInterface;

final class GetAuthenticatedUserUseCase
{
    public function __construct(
        private readonly AuthenticationServiceInterface $authenticationService
    ) {
    }

    public function handle(): GetAuthenticatedUserOutputBoundary
    {
        $user = $this->authenticationService->getAuthenticatedUser();

        return new GetAuthenticatedUserOutputBoundary(
            uuid: $user->uuid,
            name: $user->name,
            email: $user->email,
            username: $user->username,
            createdAt: $user->createdAt,
            picture: $user->picture,
            updatedAt: $user->updatedAt
        );
    }
}
