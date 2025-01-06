<?php

namespace App\Virtual\Logout\Endpoints;

/**
 * @OA\Post(
 *     path="logout",
 *     operationId="logout",
 *     tags={"Authentication"},
 *     summary="Logout",
 *     description="Logout the authenticated user.",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=204,
 *         description="Successful logout, no content returned"
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResponseVirtual")
 *     )
 * )
 */
class LogoutEndpointVirtual
{
}
