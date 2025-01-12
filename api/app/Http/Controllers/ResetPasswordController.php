<?php

namespace App\Http\Controllers;

use App\Http\Requests\{CheckEmailRequest, ConfirmPasswordResetTokenRequest, ResetPasswordRequest};
use Illuminate\Http\Response;
use Src\Application\UseCases\Authentication\ConfirmPasswordResetToken\{ConfirmPasswordResetTokenInputBoundary,
    ConfirmPasswordResetTokenUseCase
};
use Src\Application\UseCases\Authentication\SendResetPasswordEmail\{SendResetPasswordEmailInputBoundary,
    SendResetPasswordEmailUseCase
};
use Src\Application\UseCases\Authentication\ResetPassword\ResetPasswordInputBoundary;
use Src\Application\UseCases\Authentication\ResetPassword\ResetPasswordUseCase;
use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class ResetPasswordController extends Controller
{
    public function sendEmail(
        CheckEmailRequest             $request,
        SendResetPasswordEmailUseCase $useCase
    ): Response
    {
        $useCase->handle(
            new SendResetPasswordEmailInputBoundary(
                new Email($request->get('email'))
            )
        );

        return new Response(
            ['message' => 'If the email exists, we will send a verification link to you continue the reset process.'],
            SymfonyResponse::HTTP_OK);
    }

    public function confirmToken(
        ConfirmPasswordResetTokenRequest $request,
        ConfirmPasswordResetTokenUseCase $useCase
    ): Response
    {
        $response = $useCase->handle(
            new ConfirmPasswordResetTokenInputBoundary(
                $request->get('token')
            )
        );

        if ($response->status === GenericExpirableTokenStatusesEnum::CONFIRMED) {
            return new Response(['message' => 'Token confirmed successfully.'], SymfonyResponse::HTTP_OK);
        } else if ($response->status === GenericExpirableTokenStatusesEnum::EXPIRED) {
            return new Response([
                'message' => 'Invalid token provided.',
                'error' => 'Token already expired.',
            ], SymfonyResponse::HTTP_BAD_REQUEST);
        } else {
            return new Response([
                'message' => 'Invalid token provided.',
                'error' => 'Invalid or already used token.',
            ], SymfonyResponse::HTTP_BAD_REQUEST);
        }
    }

    public function resetPassword(
        ResetPasswordRequest $request,
        ResetPasswordUseCase $useCase
    ): Response
    {
        $response = $useCase->handle(
            new ResetPasswordInputBoundary(
                token: $request->get('token'),
                password: $request->get('password'),
                passwordConfirmation: $request->get('password_confirmation')
            )
        );

        if ($response->success) {
            return new Response([
                'message' => 'Password reset successfully!'
            ], SymfonyResponse::HTTP_OK);
        }

        return match ($response->tokenStatus) {
            GenericExpirableTokenStatusesEnum::EXPIRED => new Response([
                'message' => 'Invalid token provided.',
                'error' => 'Token already expired.',
            ], SymfonyResponse::HTTP_BAD_REQUEST),
            GenericExpirableTokenStatusesEnum::INVALID => new Response([
                'message' => 'Invalid token provided.',
                'error' => 'Invalid or already used token.',
            ], SymfonyResponse::HTTP_BAD_REQUEST),
            default => new Response([
                'message' => 'Could not reset the password.',
                'error' => 'The server has failed processing your request. Try again later.',
            ], SymfonyResponse::HTTP_INTERNAL_SERVER_ERROR),
        };
    }
}
