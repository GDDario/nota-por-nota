<?php

namespace Src\Application\UseCases\User\ConfirmUpdateEmailToken;

use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;
use Src\Domain\Repositories\EmailUpdateTokenRepositoryInterface;

final readonly class ConfirmUpdateEmailTokenUseCase
{
    public function __construct(
        private EmailUpdateTokenRepositoryInterface $repository
    ) {

    }

   public function handle(
       ConfirmUpdateEmailTokenInputBoundary $input
   ): ConfirmUpdateEmailTokenOutputBoundary
   {
       $token  = $this->repository->findByToken($input->token);
       $status = GenericExpirableTokenStatusesEnum::CONFIRMED;

       if (!$token) {
           $status = GenericExpirableTokenStatusesEnum::INVALID;
       } else if ($token->expiresAt < now()) {
           $status = GenericExpirableTokenStatusesEnum::EXPIRED;
       }

       return new ConfirmUpdateEmailTokenOutputBoundary(
          $status
       );
   }
}
