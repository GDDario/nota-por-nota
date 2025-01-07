<?php

namespace Src\Application\UseCases\Authentication\ConfirmPasswordResetToken;

use Src\Domain\Enums\PasswordResetTokenStatusesEnum;

final class ConfirmPasswordResetTokenOutputBoundary
{
    public function __construct(
        public PasswordResetTokenStatusesEnum $status
    ) {
    }
}
