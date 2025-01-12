<?php

use App\Http\Controllers\{AuthenticatedUserController,
    LoginController,
    LogoutController,
    RefreshTokenController,
    RegisterController,
    ResetPasswordController,
    UpdateUserEmailController,
    UserController};
use Illuminate\Support\Facades\Route;

Route::post('register', RegisterController::class);
Route::post('login', LoginController::class);
Route::post('refresh-token', RefreshTokenController::class);

Route::prefix('reset-password')->group(function () {
    Route::post('send-email', [ResetPasswordController::class, 'sendEmail']);
    Route::post('confirm-token', [ResetPasswordController::class, 'confirmToken']);
    Route::put('', [ResetPasswordController::class, 'resetPassword']);
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('auth-user', AuthenticatedUserController::class);
    Route::post('logout', LogoutController::class);

    Route::prefix('user')->group(function () {
        Route::put('', [UserController::class, 'update']);
        Route::post('update-picture', [UserController::class, 'updatePicture']);

        Route::prefix('update-email')->group(function () {
            Route::post('send-verification-link', [UpdateUserEmailController::class, 'sendVerificationLink']);
            Route::post('confirm-token', [UpdateUserEmailController::class, 'confirmToken']);
            Route::put('', [UpdateUserEmailController::class, 'updateEmail']);
        });
    });
});



// Route::get('/user', function (Request $request) {
//    return $request->user();
// })->middleware('auth:sanctum');
