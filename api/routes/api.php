<?php

use App\Http\Controllers\{AuthenticatedUserController,
    LoginController,
    LogoutController,
    RefreshTokenController,
    RegisterController,
    ResetPasswordController,
    UpdateUserEmailController};
use Illuminate\Support\Facades\Route;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('refresh-token', RefreshTokenController::class);

Route::prefix('reset-password')->group(function () {
    Route::post('send-email', [ResetPasswordController::class, 'sendEmail']);
    Route::post('confirm-token', [ResetPasswordController::class, 'confirmToken']);
    Route::post('', [ResetPasswordController::class, 'resetPassword']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('logout', LogoutController::class);

    Route::get('auth-user', AuthenticatedUserController::class);

    Route::prefix('user')->group(function () {
        Route::prefix('update-email')->group(function () {
            Route::post('send-verification-link', [UpdateUserEmailController::class, 'sendVerificationLink']);
        });
    });
});



// Route::get('/user', function (Request $request) {
//    return $request->user();
// })->middleware('auth:sanctum');
