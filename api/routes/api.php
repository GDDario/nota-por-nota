<?php

use App\Http\Controllers\{AuthenticatedUserController,
    LoginController,
    LogoutController,
    RefreshTokenController,
    RegisterController};
use Illuminate\Support\Facades\Route;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('refresh-token', RefreshTokenController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', LogoutController::class);

    Route::get('auth_user', AuthenticatedUserController::class);
});

// Route::get('/user', function (Request $request) {
//    return $request->user();
// })->middleware('auth:sanctum');
