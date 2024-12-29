<?php

namespace Src\Application\UseCases\User\Store;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Src\Application\DTOs\CreateUserDTO;
use Src\Domain\Repositories\UserRepositoryInterface;
use Src\Domain\ValueObjects\Uuid;

final class UserStoreUseCase
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {
    }

    public function handle(UserStoreInputBoundary $input): UserStoreOutputBoundary
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

        $data = $this->userRepository->create($dto);

        return new UserStoreOutputBoundary(
            $data->uuid,
            $data->name,
            $data->email,
            $data->username,
            $data->createdAt
        );
    }
}
