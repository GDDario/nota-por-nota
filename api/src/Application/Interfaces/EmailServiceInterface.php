<?php

namespace Src\Application\Interfaces;

use Illuminate\Mail\Mailable;

interface EmailServiceInterface
{
    public function sendMailable(string $to, Mailable $mailable): bool;
}
