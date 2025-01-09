<?php

namespace Src\Application\UseCases\Authentication\ConfirmPasswordResetToken;

use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;

final readonly class ConfirmPasswordResetTokenOutputBoundary
{
    public function __construct(
        public GenericExpirableTokenStatusesEnum $status
    )
    {
    }
}
