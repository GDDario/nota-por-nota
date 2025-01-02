<?php

namespace Src\Application\UseCases\Authentication\Login;

use Src\Domain\Exceptions\AuthenticationException;
use Src\Domain\Repositories\UserRepositoryInterface;
use Src\Domain\Services\AuthenticationServiceInterface;

final class LoginUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly AuthenticationServiceInterface $authenticationService
    ) {
    }

    /**
     * @throws AuthenticationException
     */
    public function handle(LoginInputBoundary $input): LoginOutputBoundary
    {
        $tokenData = $this->authenticationService->login([
            'email'    => $input->email,
            'password' => $input->password,
        ]);

        $user = $this->userRepository->findByEmail($input->email);

        return new LoginOutputBoundary(
            uuid: $user->uuid,
            name: $user->name,
            email: $user->email,
            username: $user->username,
            createdAt: $user->createdAt,
            tokenData: $tokenData,
            updatedAt: $user->updatedAt
        );
    }
}
