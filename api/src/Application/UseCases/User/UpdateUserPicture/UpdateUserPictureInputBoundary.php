<?php

namespace Src\Application\UseCases\User\UpdateUserPicture;

use Illuminate\Http\UploadedFile;
use Src\Domain\ValueObjects\Email;

final readonly class UpdateUserPictureInputBoundary
{
    public function __construct(
        public Email        $email,
        public UploadedFile $picture,
        public UploadedFile $originalPicture
    )
    {
    }
}
