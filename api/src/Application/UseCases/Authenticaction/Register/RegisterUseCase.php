<?php

namespace Src\Application\UseCases\Authenticaction\Register;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Repositories\UserRepositoryInterface;
use Src\Domain\Services\AuthenticationServiceInterface;
use Src\Domain\ValueObjects\Uuid;

final class RegisterUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface        $userRepository,
        private readonly AuthenticationServiceInterface $authenticationService
    )
    {
    }

    public function handle(RegisterInputBoundary $input): RegisterOutputBoundary
    {
        if ($input->password !== $input->passwordConfirmation) {
            throw new InvalidArgumentException('The passwords do not match');
        }

        $dto = new CreateUserDTO(
            new Uuid(RamseyUuid::uuid4()->toString()),
            $input->name,
            $input->email,
            $input->username,
            $input->password
        );

        $userData = $this->userRepository->create($dto);
        $tokenData = $this->authenticationService->login([
            'email' => $input->email,
            'password' => $input->password
        ]);

        return new RegisterOutputBoundary(
            uuid: $userData->uuid,
            name: $userData->name,
            email: $userData->email,
            username: $userData->username,
            createdAt: $userData->createdAt,
            accessToken: $tokenData->accessToken,
            refreshToken: $tokenData->refreshToken,
            expiresAt: $tokenData->expiresAt
        );
    }
}
