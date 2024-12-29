<?php

namespace Src\Application\UseCases\User\Store;

use DateTime;
use Src\Domain\ValueObjects\Email;
use Src\Domain\ValueObjects\Uuid;

final class UserStoreOutputBoundary
{
    public function __construct(
        public Uuid     $uuid,
        public string   $name,
        public Email    $email,
        public string   $username,
        public DateTime $createdAt
    )
    {
    }
}
