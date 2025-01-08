<?php

namespace Src\Application\UseCases\Authentication\ResetPassword;

use App\Mail\PasswordHasBeenResetEmail;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Password;
use InvalidArgumentException;
use Src\Application\Interfaces\EmailServiceInterface;
use Src\Domain\Enums\PasswordResetTokenStatusesEnum;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;
use Src\Domain\Repositories\UserRepositoryInterface;

final readonly class ResetPasswordUseCase
{
    public function __construct(
        private PasswordResetTokenRepositoryInterface $tokenRepository,
        private UserRepositoryInterface               $userRepository,
        private EmailServiceInterface                 $emailService
    ) {
    }

    public function handle(
        ResetPasswordInputBoundary $input
    ): ResetPasswordOutputBoundary
    {
        $token = $this->tokenRepository->findByToken($input->token);

        if ($token) {
            if ($token->isExpired()) {
                $tokenStatus = PasswordResetTokenStatusesEnum::EXPIRED;
            } else {
                $this->tokenRepository->deleteByToken($input->token);

                $user = $this->userRepository->updatePassword($token->email, $input->password);

                $tokenStatus = PasswordResetTokenStatusesEnum::CONFIRMED;
                $mailable = new PasswordHasBeenResetEmail($user->name);
                $this->emailService->sendMailable($token->email, $mailable);
            }
        } else {
            $tokenStatus = PasswordResetTokenStatusesEnum::INVALID;
        }

        return new ResetPasswordOutputBoundary(
            success: $tokenStatus === PasswordResetTokenStatusesEnum::CONFIRMED,
            tokenStatus: $tokenStatus
        );
    }
}
