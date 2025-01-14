<?php

namespace Src\Application\UseCases\User\UpdateUser;

use Src\Domain\Repositories\UserRepositoryInterface;

final readonly class UpdateUserUseCase
{
    public function __construct(
        public UserRepositoryInterface $repository
    ) {}

    public function handle(
        UpdateUserInputBoundary $input
    ): UpdateUserOutputBoundary
    {
        $user = $this->repository->update($input->email, $input->name, $input->username);

        return new UpdateUserOutputBoundary(
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
