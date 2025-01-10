<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfirmUpdateEmailTokenRequest;
use App\Http\Requests\UpdateUserEmailRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Application\UseCases\User\ConfirmUpdateEmailToken\ConfirmUpdateEmailTokenInputBoundary;
use Src\Application\UseCases\User\ConfirmUpdateEmailToken\ConfirmUpdateEmailTokenUseCase;
use Src\Application\UseCases\User\SendUpdateEmailVerificationLink\SendUpdateEmailVerificationLinkInputBoundary;
use Src\Application\UseCases\User\SendUpdateEmailVerificationLink\SendUpdateEmailVerificationLinkUseCase;
use Src\Application\UseCases\User\UpdateUserEmail\UpdateUserEmailInputBoundary;
use Src\Application\UseCases\User\UpdateUserEmail\UpdateUserEmailUseCase;
use Src\Domain\Enums\GenericExpirableTokenStatusesEnum;
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UpdateUserEmailController extends Controller
{
    public function sendVerificationLink(
        Request                                $request,
        SendUpdateEmailVerificationLinkUseCase $useCase
    ): Response
    {
        $user = $request->user();

        $useCase->handle(
            new SendUpdateEmailVerificationLinkInputBoundary(
                $user->name,
                new Email($user->email)
            )
        );

        return new Response(
            ['message' => 'Email sent successfully. Check your inbox for further explanation.'],
            SymfonyResponse::HTTP_OK
        );
    }

    public function confirmToken(
        ConfirmUpdateEmailTokenRequest $request,
        ConfirmUpdateEmailTokenUseCase $useCase
    ): Response
    {
        $response = $useCase->handle(
            new ConfirmUpdateEmailTokenInputBoundary(
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

    public function updateEmail(
        UpdateUserEmailRequest $request,
        UpdateUserEmailUseCase $useCase
    )
    {
        $response = $useCase->handle(
            new UpdateUserEmailInputBoundary(
                $request->get('token'),
                new Email($request->get('email')),
                new Email($request->get('email_confirmation')),
            )
        );

        if ($response->success) {
            return new Response([
                'message' => 'Email updated successfully!'
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
