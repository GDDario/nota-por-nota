<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Src\Application\UseCases\Authentication\Logout\LogoutUseCase;

class LogoutController extends Controller
{
    public function __invoke(LogoutUseCase $useCase): void
    {
        $useCase->handle();
    }
}
