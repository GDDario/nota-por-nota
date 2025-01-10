<?php

namespace Src\Application\UseCases\User\ConfirmUpdateEmailToken;

use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;

final readonly class ConfirmUpdateEmailTokenOutputBoundary
{
    public function __construct(
        public GenericExpirableTokenStatusesEnum $status
    )
    {
    }
}
