<?php

namespace Src\InterfaceAdapters\Services;

use Exception;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\{Log, Mail};
use Src\Application\Interfaces\EmailServiceInterface;

class SmtpEmailService implements EmailServiceInterface
{
    public function sendMailable(string $to, Mailable $mailable): bool
    {
        try {
            Mail::to($to)->send($mailable);

            return true;
        } catch (Exception $e) {
            Log::error($e->getMessage());

            return false;
        }
    }
}
