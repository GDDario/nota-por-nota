<?php

namespace Src\Application\UseCases\Authentication\ResetPassword;

use Illuminate\Auth\Notifications\ResetPassword;
use InvalidArgumentException;
use Src\Application\Interfaces\EmailServiceInterface;
use Src\Domain\Enums\PasswordResetTokenStatusesEnum;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;
use Src\Domain\Repositories\UserRepositoryInterface;

final class ResetPasswordUseCase
{
    public function __construct(
        private readonly PasswordResetTokenRepositoryInterface $tokenRepository,
        private readonly UserRepositoryInterface               $userRepository,
        private readonly EmailServiceInterface                 $emailService
    )
    {
    }

    public function handle(
        ResetPasswordInputBoundary $input
    ): ResetPasswordOutputBoundary
    {
        if ($input->password !== $input->passwordConfirmation) {
            throw new InvalidArgumentException('The passwords do not match');
        }


        $token = $this->tokenRepository->existsByToken($input->token);

        if ($token) {
            $this->tokenRepository->deleteById($token->id);

            $this->userRepository->updatePassword($input->password);

            $tokenStatus = PasswordResetTokenStatusesEnum::CONFIRMED;
        } else {

        }

        return new ResetPasswordOutputBoundary();
    }
}
