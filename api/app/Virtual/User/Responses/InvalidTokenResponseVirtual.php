<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="Invalid Token Response",
 *      description="Response when an invalid token is provided",
 *      type="object"
 * )
 */
class InvalidTokenResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="Invalid token provided."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Error",
     *      description="Detailed error message",
     *      example="Invalid or already used token."
     * )
     */
    public string $error;
}
