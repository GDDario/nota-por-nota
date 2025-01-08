<?php

namespace App\Virtual\ResetPassword\Responses;

/**
 * @OA\Schema(
 *     title="Expired Reset Token Response",
 *     description="Response when the reset password token is expired",
 *     type="object"
 * )
 */
class ExpiredResetTokenResponseVirtual
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
     *     example="Token already expired."
     * )
     */
    public string $error;
}
