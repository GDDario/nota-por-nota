<?php

namespace App\Virtual\RefreshToken\Responses;

/**
 * @OA\Schema(
 *      title="Refresh Token Field Required Response",
 *      description="Error response when refresh token is not provided",
 *      type="object"
 * )
 */
class RefreshTokenFieldRequiredResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     example="The refresh token field is required."
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
     *         @OA\Items(type="string", example="The refresh token field is required.")
     *     )
     * )
     */
    public object $errors;
}
