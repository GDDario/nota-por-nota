<?php

namespace Src\Application\UseCases\User\UpdateUserEmail;

use App\Mail\NewEmailNotification;
use App\Mail\PasswordHasBeenResetEmail;
use App\Mail\UserEmailUpdatedNotification;
use Src\Application\Interfaces\EmailServiceInterface;
use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;
use Src\Domain\Repositories\EmailUpdateTokenRepositoryInterface;
use Src\Domain\Repositories\UserRepositoryInterface;

final readonly class UpdateUserEmailUseCase
{
    public function __construct(
        private UserRepositoryInterface             $userRepository,
        private EmailUpdateTokenRepositoryInterface $tokenRepository,
        private EmailServiceInterface               $emailService
    )
    {
    }

    public function handle(
        UpdateUserEmailInputBoundary $input
    ): UpdateUserEmailOutputBoundary
    {
        $token = $this->tokenRepository->findByToken($input->token);

        if ($token) {
            if ($token->isExpired()) {
                $tokenStatus = GenericExpirableTokenStatusesEnum::EXPIRED;
            } else {
                $this->tokenRepository->deleteByToken($input->token);

                $user = $this->userRepository->updateEmail($token->email, $input->email);

                $tokenStatus = GenericExpirableTokenStatusesEnum::CONFIRMED;
                $mailable = new UserEmailUpdatedNotification($user->name, now()->format('Y-m-d h:i:s'));
                $this->emailService->sendMailable($token->email, $mailable);

                $mailable = new NewEmailNotification($user->name, now()->format('Y-m-d h:i:s'));
                $this->emailService->sendMailable($token->email, $mailable);
            }
        } else {
            $tokenStatus = GenericExpirableTokenStatusesEnum::INVALID;
        }

        return new UpdateUserEmailOutputBoundary(
            success: $tokenStatus === GenericExpirableTokenStatusesEnum::CONFIRMED,
            tokenStatus: $tokenStatus
        );
    }
}
