<?php

namespace Src\Application\UseCases\Authentication\SendResetPasswordEmail;

use App\Mail\SendResetPasswordEmail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Src\Application\Interfaces\EmailServiceInterface;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;
use Src\Domain\Repositories\UserRepositoryInterface;

final class SendResetPasswordEmailUseCase
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly PasswordResetTokenRepositoryInterface $passwordResetTokenRepository,
        private readonly EmailServiceInterface $emailService
    )
    {

    }

    public function handle(SendResetPasswordEmailInputBoundary $input): void
    {
        $user = $this->userRepository->findByEmail($input->email);

        if ($user != null) {
            $token = $this->generateToken();
            $mailable = new SendResetPasswordEmail($user->name, $token);
            $this->emailService->sendMailable($input->email, $mailable);
            $this->passwordResetTokenRepository->create($input->email, $token);
        }
    }

    private function generateToken(): string {
        return Str::random(100);
    }
}
