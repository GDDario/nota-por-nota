<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserPictureRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Src\Application\UseCases\User\UpdateUserPicture\UpdateUserPictureInputBoundary;
use Src\Application\UseCases\User\UpdateUserPicture\UpdateUserPictureUseCase;
use Src\Domain\ValueObjects\Email;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    public function updatePicture(
        UpdateUserPictureRequest $request,
        UpdateUserPictureUseCase $useCase
    ) {
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
