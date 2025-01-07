<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\{Content, Envelope};
use Illuminate\Queue\SerializesModels;

class SendResetPasswordEmail extends Mailable
{
    use Queueable;
    use SerializesModels;

    public function __construct(
        private string $userName,
        private string $token
    ) {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Send Reset Password Email',
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'mail.send-reset-password-email',
        )->with([
            'userName' => $this->userName,
            'token'    => $this->token,
        ]);
    }

    /**
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
