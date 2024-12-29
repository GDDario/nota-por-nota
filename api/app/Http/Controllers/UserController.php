<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Application\UseCases\User\Store\UserStoreInputBoundary;
use Src\Application\UseCases\User\Store\UserStoreUseCase;
use Src\Domain\ValueObjects\Email;

class UserController extends Controller
{
    public function index()
    {
    }

    public function store(
        UserStoreRequest $request,
        UserStoreUseCase $useCase
    ): Response
    {
        $response = $useCase->handle(
            new UserStoreInputBoundary(
                $request->input('name'),
                new Email($request->input('email')),
                $request->input('username'),
                $request->input('password'),
                $request->input('password_confirmation')
            )
        );

        return new Response([
            'message' => 'User created successfully.',
            'data' => [
                'uuid' => (string)$response->uuid,
                'name' => $response->name,
                'email' => (string)$response->email,
                'username' => $response->username,
                'created_at' => $response->createdAt,
            ]
        ], Response::HTTP_CREATED);
    }

    public function show(User $user)
    {
    }

    public function update(Request $request, User $user)
    {
    }

    public function destroy(User $user)
    {
    }
}
