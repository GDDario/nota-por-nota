<?php

namespace App\Virtual\ResetPassword\Responses;

/**
 * @OA\Schema(
 *     title="Invalid Reset Token Response",
 *     description="Response when the reset password token is invalid or already used",
 *     type="object"
 * )
 */
class InvalidResetTokenResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     example="Invalid token provided."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *     title="Error",
     *     description="Detailed error message",
     *     example="Invalid or already used token."
     * )
     */
    public string $error;
}
