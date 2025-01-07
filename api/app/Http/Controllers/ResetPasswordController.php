<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CheckEmailRequest, ConfirmPasswordResetTokenRequest};
use Illuminate\Http\Response;
use Src\Application\UseCases\Authentication\ConfirmPasswordResetToken\{ConfirmPasswordResetTokenInputBoundary, ConfirmPasswordResetTokenUseCase};
use Src\Application\UseCases\Authentication\SendResetPasswordEmail\{SendResetPasswordEmailInputBoundary, SendResetPasswordEmailUseCase};
use Src\Domain\Enums\PasswordResetTokenStatusesEnum;
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ResetPasswordController extends Controller
{
    public function confirmToken(
        ConfirmPasswordResetTokenRequest $request,
        ConfirmPasswordResetTokenUseCase $useCase
    ): Response {
        $response = $useCase->handle(
            new ConfirmPasswordResetTokenInputBoundary(
                $request->get('token')
            )
        );

        if ($response->status === PasswordResetTokenStatusesEnum::CONFIRMED) {
            return new Response(['message' => 'Token confirmed successfully.'], SymfonyResponse::HTTP_OK);
        } else if ($response->status === PasswordResetTokenStatusesEnum::EXPIRED) {
            return new Response([
                'message' => 'Invalid token provided.',
                'error'   => 'Token already expired.',
            ], SymfonyResponse::HTTP_BAD_REQUEST);
        } else {
            return new Response([
                'message' => 'Invalid token provided.',
                'error'   => 'Invalid or already used token.',
            ], SymfonyResponse::HTTP_BAD_REQUEST);
        }
    }

    public function sendEmail(
        CheckEmailRequest             $request,
        SendResetPasswordEmailUseCase $useCase
    ): Response {
        $useCase->handle(
            new SendResetPasswordEmailInputBoundary(
                new Email($request->get('email'))
            )
        );

        return new Response(['message' => 'If the email exists, we will send a verification link to you continue the reset process.'], SymfonyResponse::HTTP_OK);
    }

    public function resetPassword()
    {

    }
}
