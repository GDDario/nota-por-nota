<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\{Exceptions, Middleware};
use Illuminate\Http\Request;
use Src\Application\Exceptions\InvalidRefreshTokenException;
use Src\Domain\Exceptions\AuthenticationException;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {
            if ($e instanceof AuthenticationException) {
                return response(
                    ['message' => $e->getMessage()],
                    Response::HTTP_BAD_REQUEST
                );
            }
            if ($e instanceof InvalidRefreshTokenException) {
                return response(
                    [
                        'message' => $e->getMessage(),
                        'errors' => [
                            'refresh_token' => [
                                $e->getMessage(),
                            ],
                        ],
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
        });
    })->create();
