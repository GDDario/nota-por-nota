<?php

namespace Src\Application\UseCases\Authentication\SendResetPasswordEmail;

use Src\Domain\ValueObjects\Email;

final class SendResetPasswordEmailInputBoundary
{
    public function __construct(
        public Email $email
    ) {

    }
}
