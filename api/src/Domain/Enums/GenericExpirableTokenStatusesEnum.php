<?php

namespace Src\Domain\Enums;

enum GenericExpirableTokenStatusesEnum: int
{
    case CONFIRMED = 1;
    case EXPIRED   = 2;
    case INVALID   = 3;
}
