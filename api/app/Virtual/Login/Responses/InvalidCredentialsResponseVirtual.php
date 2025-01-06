<?php

namespace App\Virtual\Login\Responses;

/**
 * @OA\Schema(
 *      title="Invalid Credentials Response",
 *      description="Response returned when invalid credentials are provided.",
 *      type="object"
 * )
 */
class InvalidCredentialsResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="Invalid credentials provided."
     * )
     */
    public string $message;
}
