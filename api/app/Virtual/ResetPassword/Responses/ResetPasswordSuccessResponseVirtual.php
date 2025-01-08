<?php

namespace App\Virtual\ResetPassword\Responses;

/**
 * @OA\Schema(
 *     title="Reset Password Success Response",
 *     description="Response when the password is reset successfully",
 *     type="object"
 * )
 */
class ResetPasswordSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Success message",
     *     example="Password reset successfully!"
     * )
     */
    public string $message;
}
