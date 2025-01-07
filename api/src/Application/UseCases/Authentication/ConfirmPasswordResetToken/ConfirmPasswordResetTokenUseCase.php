<?php

namespace Src\Application\UseCases\Authentication\ConfirmPasswordResetToken;

use Src\Domain\Enums\PasswordResetTokenStatusesEnum;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;

final class ConfirmPasswordResetTokenUseCase
{
    public function __construct(
        private PasswordResetTokenRepositoryInterface $tokenRepository,
    ) {

    }

    public function handle(
        ConfirmPasswordResetTokenInputBoundary $input
    ): ConfirmPasswordResetTokenOutputBoundary
    {
        $token = $this->tokenRepository->findByToken($input->token);
        $status = PasswordResetTokenStatusesEnum::CONFIRMED;

        if (!$token) {
            $status = PasswordResetTokenStatusesEnum::INVALID;
        } else if ($token->expiresAt < now()) {
            $status = PasswordResetTokenStatusesEnum::EXPIRED;
        }

        return new ConfirmPasswordResetTokenOutputBoundary(
            $status
        );
    }
}
