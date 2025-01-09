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

    public function handle(
        ConfirmPasswordResetTokenInputBoundary $input
    ): ConfirmPasswordResetTokenOutputBoundary
    {

        $status = $this->status;

        return new ConfirmPasswordResetTokenOutputBoundary(
            $this->status
        );
    }
}
