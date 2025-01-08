<?php

namespace Src\Application\UseCases\Authentication\ResetPassword;

use Src\Domain\Enums\PasswordResetTokenStatusesEnum;

final readonly class ResetPasswordOutputBoundary
{
    public function __construct(
        public bool $success,
        public PasswordResetTokenStatusesEnum $tokenStatus
    ) {
    }
}
