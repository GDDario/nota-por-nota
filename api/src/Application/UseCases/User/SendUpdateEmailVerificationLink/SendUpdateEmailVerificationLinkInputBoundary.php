<?php

namespace Src\Application\UseCases\User\SendUpdateEmailVerificationLink;

use Src\Domain\ValueObjects\Email;

final readonly class SendUpdateEmailVerificationLinkInputBoundary
{
    public function __construct(
        public string $name,
        public Email $email
    ) {

    }
}
