<?php

namespace Src\Domain\Enums;

enum PasswordResetTokenStatusesEnum: int
{
    case CONFIRMED = 1;
    case EXPIRED   = 2;
    case INVALID   = 3;
}
