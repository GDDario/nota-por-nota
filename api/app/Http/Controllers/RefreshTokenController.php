<?php

namespace App\Http\Controllers;

use App\Http\Requests\RefreshTokenRequest;
use Illuminate\Http\Response;
use Src\Application\UseCases\Authentication\RefreshAccessToken\RefreshAccessTokenUseCase;
use Src\Application\UseCases\Authentication\RefreshAccessToken\RefreshTokenInputBoundary;

class RefreshTokenController extends Controller
{
    public function __invoke(
        RefreshTokenRequest       $request,
        RefreshAccessTokenUseCase $useCase
    ): Response
    {
        $response = $useCase->handle(
            new RefreshTokenInputBoundary(
                $request->string('refresh_token')
            )
        );
        $tokensDTO = $response->tokensDTO;

        return new Response([
            'data' => [
                'access_token' => $tokensDTO->accessToken,
                'refresh_token' => $tokensDTO->refreshToken,
                'expires_at' => $tokensDTO->expiresAt->format('Y-m-d\TH:i:s.u\Z'),
            ]
        ], 200);
    }
}
