<?php

namespace App\Virtual\RefreshToken\Responses;

/**
 * @OA\Schema(
 *      title="Refresh Token Success Response",
 *      description="Successful response containing new access and refresh tokens",
 *      type="object"
 * )
 */
class RefreshTokenSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="The data containing tokens and expiry.",
     *     type="object",
     *     @OA\Property(
     *         property="access_token",
     *         title="Access Token",
     *         description="The new access token",
     *         example="44|GnngQJl0zJEpSs2VscSSyQMudJRYG8cQ91eCMmGC6ec307ed"
     *     ),
     *     @OA\Property(
     *         property="refresh_token",
     *         title="Refresh Token",
     *         description="The new refresh token",
     *         example="4be8606e2deff652d104bf8035348cf253406841a44cf0d01ed15f1e477b6225"
     *     ),
     *     @OA\Property(
     *         property="expires_at",
     *         title="Expires At",
     *         description="The expiration date and time of the access token",
     *         example="2025-01-06T16:04:55.972540Z"
     *     )
     * )
     */
    public object $data;
}
