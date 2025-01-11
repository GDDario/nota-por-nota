<?php

namespace Src\Application\UseCases\User\UpdateUserPicture;

use Src\Domain\Repositories\UserRepositoryInterface;

final readonly class UpdateUserPictureUseCase
{
    public function __construct(
        private UserRepositoryInterface $repository
    )
    {
    }

    public function handle(UpdateUserPictureInputBoundary $input): void
    {
        $picturePath = $input->picture->store('pictures', 'public');
        $originalPicturePath = $input->originalPicture->store('pictures', 'public');
        $this->repository->updatePicture($input->email, $picturePath, $originalPicturePath);
    }
}
