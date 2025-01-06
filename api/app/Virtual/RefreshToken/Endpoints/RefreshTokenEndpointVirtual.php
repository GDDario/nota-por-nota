<?php

namespace App\Virtual\RefreshToken\Endpoints;

/**
 * @OA\Post(
 *     path="refresh-token",
 *     operationId="refreshToken",
 *     tags={"Authentication"},
 *     summary="Refresh Access Token",
 *     description="Get a new access token using the refresh token.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/RefreshTokenRequestVirtual")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Token refreshed successfully",
 *         @OA\JsonContent(ref="#/components/schemas/RefreshTokenSuccessResponseVirtual")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 schema=@OA\Schema(
 *                     allOf={
 *                         @OA\Schema(ref="#/components/schemas/InvalidRefreshTokenResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/RefreshTokenFieldRequiredResponseVirtual")
 *                     }
 *                 )
 *             )
 *         }
 *     )
 * )
 */
class RefreshTokenEndpointVirtual
{
}
