<?php

namespace Src\Application\UseCases\User\SendUpdateEmailVerificationLink;

use App\Http\Controllers\UpdateUserEmailController;
use App\Mail\UpdateUserEmailVerification;
use Illuminate\Support\Str;
use Src\Application\Interfaces\EmailServiceInterface;
use Src\Domain\Repositories\EmailUpdateTokenRepositoryInterface;
use Src\Domain\Repositories\UserRepositoryInterface;

final readonly class SendUpdateEmailVerificationLinkUseCase
{
    public function __construct(
        private EmailUpdateTokenRepositoryInterface $repository,
        private EmailServiceInterface               $emailService
    )
    {
    }

    public function handle(
        SendUpdateEmailVerificationLinkInputBoundary $input
    ): void
    {
        $token = $this->generateToken();
        $this->repository->create($input->email, $token);
        $mailable = new UpdateUserEmailVerification($input->name, $token);
        $this->emailService->sendMailable($input->email, $mailable);
    }

    private function generateToken(): string
    {
        return Str::random(100);
    }
}
