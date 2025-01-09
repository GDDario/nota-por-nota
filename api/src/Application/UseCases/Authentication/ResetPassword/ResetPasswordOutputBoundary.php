<?php

namespace Src\Application\UseCases\Authentication\ResetPassword;

use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;

final readonly class ResetPasswordOutputBoundary
{
    public function __construct(
        public bool $success,
        public GenericExpirableTokenStatusesEnum $tokenStatus
    ) {
    }
}
