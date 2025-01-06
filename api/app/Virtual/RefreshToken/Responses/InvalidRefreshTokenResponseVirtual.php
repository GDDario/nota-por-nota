<?php

namespace App\Virtual\RefreshToken\Responses;

/**
 * @OA\Schema(
 *      title="Invalid Refresh Token Response",
 *      description="Error response for invalid refresh token",
 *      type="object"
 * )
 */
class InvalidRefreshTokenResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     example="The selected refresh token is invalid."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *     title="Errors",
     *     description="Detailed errors",
     *     type="object",
     *     @OA\Property(
     *         property="refresh_token",
     *         type="array",
     *         @OA\Items(type="string", example="The selected refresh token is invalid.")
     *     )
     * )
     */
    public object $errors;
}
