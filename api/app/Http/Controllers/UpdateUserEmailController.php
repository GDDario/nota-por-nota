<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Application\UseCases\User\SendUpdateEmailVerificationLink\SendUpdateEmailVerificationLinkInputBoundary;
use Src\Application\UseCases\User\SendUpdateEmailVerificationLink\SendUpdateEmailVerificationLinkUseCase;
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UpdateUserEmailController extends Controller
{
    public function sendVerificationLink(
        Request $request,
        SendUpdateEmailVerificationLinkUseCase $useCase
    ): Response {
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
}
