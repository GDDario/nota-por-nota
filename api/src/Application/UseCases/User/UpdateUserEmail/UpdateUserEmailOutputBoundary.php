<?php

namespace Src\Application\UseCases\User\UpdateUserEmail;

use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;

final readonly class UpdateUserEmailOutputBoundary
{
    public function __construct(
        public bool                              $success,
        public GenericExpirableTokenStatusesEnum $tokenStatus
    )
    {
    }
}
