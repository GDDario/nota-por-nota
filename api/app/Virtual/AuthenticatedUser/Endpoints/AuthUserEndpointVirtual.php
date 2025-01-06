<?php

namespace App\Virtual\AuthenticatedUser\Endpoints;

/**
 * @OA\Get(
 *     path="auth-user",
 *     operationId="authUser",
 *     tags={"Authentication"},
 *     summary="Get Authenticated User",
 *     description="Retrieve the currently authenticated user's information.",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Authenticated user retrieved successfully",
 *         @OA\JsonContent(ref="#/components/schemas/AuthUserSuccessResponseVirtual")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthorized - User not authenticated",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResponseVirtual")
 *     )
 * )
 */
class AuthUserEndpointVirtual
{
}
