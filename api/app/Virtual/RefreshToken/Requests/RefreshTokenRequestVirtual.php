<?php

namespace App\Virtual\RefreshToken\Requests;

/**
 * @OA\Schema(
 *      title="Refresh Token Request",
 *      description="Body data for refreshing access token",
 *      type="object",
 *      required={"refresh_token"}
 * )
 */
class RefreshTokenRequestVirtual
{
    /**
     * @OA\Property(
     *     title="Refresh Token",
     *     description="The refresh token used to generate a new access token.",
     *     example="4be8606e2deff652d104bf8035348cf253406841a44cf0d01ed15f1e477b6225"
     * )
     */
    public string $refresh_token;
}
