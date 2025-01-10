<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="Expired Token Response",
 *      description="Response when the provided token is expired",
 *      type="object"
 * )
 */
class ExpiredTokenResponseVirtual
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
     *      example="Token already expired."
     * )
     */
    public string $error;
}
