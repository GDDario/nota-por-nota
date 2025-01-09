<?php

namespace Src\Application\UseCases\Authentication\ConfirmPasswordResetToken;

use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;
use Src\Domain\Repositories\PasswordResetTokenRepositoryInterface;

final readonly class ConfirmPasswordResetTokenUseCase
{
    public function __construct(
        private PasswordResetTokenRepositoryInterface $tokenRepository,
    ) {

    }

    public function handle(
        ConfirmPasswordResetTokenInputBoundary $input
    ): ConfirmPasswordResetTokenOutputBoundary {
        $token  = $this->tokenRepository->findByToken($input->token);
        $status = GenericExpirableTokenStatusesEnum::CONFIRMED;

        if (!$token) {
            $status = GenericExpirableTokenStatusesEnum::INVALID;
        } else if ($token->expiresAt < now()) {
            $status = GenericExpirableTokenStatusesEnum::EXPIRED;
        }

        return new ConfirmPasswordResetTokenOutputBoundary(
            $status
        );
    }
}
