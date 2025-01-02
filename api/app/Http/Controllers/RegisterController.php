<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Response;
use Src\Application\UseCases\Authentication\Register\{RegisterInputBoundary, RegisterUseCase};
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class RegisterController
{
    public function __invoke(
        RegisterRequest $request,
        RegisterUseCase $useCase
    ): Response {
        $response = $useCase->handle(
            new RegisterInputBoundary(
                $request->input('name'),
                new Email($request->input('email')),
                $request->input('username'),
                $request->input('password'),
                $request->input('password_confirmation')
            )
        );

        return new Response([
            'message' => 'User created successfully.',
            'data'    => [
                'uuid'       => (string) $response->uuid,
                'name'       => $response->name,
                'email'      => (string) $response->email,
                'username'   => $response->username,
                'created_at' => $response->createdAt,
            ],
            'access_token'  => $response->tokenData->accessToken,
            'refresh_token' => $response->tokenData->refreshToken,
            'expires_at'    => $response->tokenData->expiresAt->format('Y-m-d\TH:i:s.u\Z'),
        ], SymfonyResponse::HTTP_CREATED);
    }
}
