<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Src\Application\UseCases\Authentication\GetAuthenticatedUser\GetAuthenticatedUserUseCase;

class AuthenticatedUserController extends Controller
{
    public function __invoke(GetAuthenticatedUserUseCase $useCase): Response
    {
        $response = $useCase->handle();

        return new Response([
            'data' => [
                'uuid' => (string)$response->uuid,
                'name' => $response->name,
                'email' => (string)$response->email,
                'username' => $response->username,
                'created_at' => $response->createdAt,
                'updated_at' => $response->updatedAt
            ]
        ], 200);
    }
}
