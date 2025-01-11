<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class UserController extends Controller
{
    public function updatePicture(
        UpdateUserPictureRequest $request,
        UpdateUserPictureUseCase $useCase
    ) {
        $result = $useCase->handle(
            new UpdateUserPictureInputBoundary(
                $request->file('picture'),
                $request->file('picture_original'),
            )
        );

        return new Response(['message' => 'Picture updated successfully!'], SymfonyResponse::HTTP_OK);
    }
}
