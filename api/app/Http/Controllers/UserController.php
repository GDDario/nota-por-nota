<?php

namespace App\Http\Controllers;

use App\Http\Requests\{UpdateUserPictureRequest, UpdateUserRequest};
use Illuminate\Http\{Response};
use Src\Application\UseCases\User\UpdateUser\{UpdateUserInputBoundary, UpdateUserUseCase};
use Src\Application\UseCases\User\UpdateUserPicture\{UpdateUserPictureInputBoundary, UpdateUserPictureUseCase};
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    public function update(
        UpdateUserRequest $request,
        UpdateUserUseCase $useCase
    ): Response {
        $email = new Email($request->user()->email);

        $result = $useCase->handle(
            new UpdateUserInputBoundary(
                $email,
                $request->get('name'),
                $request->get('username'),
            )
        );

        return new Response([
            'data' => [
                'user' => [
                    'uuid'       => (string) $result->uuid,
                    'name'       => $result->name,
                    'email'      => (string) $result->email,
                    'username'   => $result->username,
                    'picture'    => $result->picture,
                    'created_at' => $result->createdAt,
                    'updated_at' => $result->updatedAt,
                ],
            ],
        ]);
    }

    public function updatePicture(
        UpdateUserPictureRequest $request,
        UpdateUserPictureUseCase $useCase
    ): Response {
        $email = new Email($request->user()->email);

        $useCase->handle(
            new UpdateUserPictureInputBoundary(
                $email,
                $request->file('picture'),
                $request->file('original_picture'),
            )
        );

        return new Response(['message' => 'Picture updated successfully!'], SymfonyResponse::HTTP_OK);
    }
}
