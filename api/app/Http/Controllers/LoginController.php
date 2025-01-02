<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Http\Response;
use Src\Application\UseCases\Authentication\Login\LoginInputBoundary;
use Src\Application\UseCases\Authentication\Login\LoginUseCase;
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class LoginController
{
    public function __invoke(
        LoginRequest $request,
        LoginUseCase $useCase
    ): Response {
        $response = $useCase->handle(
            new LoginInputBoundary(
                email: new Email($request->input('email')),
                password: $request->input('password'),
            )
        );

        return new Response([
            'message' => 'Successfully logged in.',
            'data' => [
                'user' => [
                    'uuid' => (string) $response->uuid,
                    'name' => $response->name,
                    'email' => (string) $response->email,
                    'username' => $response->username,
                    'created_at' => $response->createdAt,
                    'updated_at' => $response->updatedAt,
                ],
                'access_token' => $response->tokenData->accessToken,
                'refresh_token' => $response->tokenData->refreshToken,
                'expires_at' => $response->tokenData->expiresAt->format('Y-m-d\TH:i:s.u\Z'),
            ],
        ], SymfonyResponse::HTTP_OK);
    }
}
