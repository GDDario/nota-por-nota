<?php

namespace App\Virtual\User\Endpoints;

/**
 * @OA\Post(
 *     path="/user/update-email/send-verification-link",
 *     operationId="sendVerificationLink",
 *     tags={"User"},
 *     summary="Send a verification link to the user's email",
 *     description="This endpoint sends an email verification link. The user must be logged in.",
 *     security={{"bearerAuth": {}}},
 *     @OA\Response(
 *         response=200,
 *         description="Successful operation",
 *         @OA\JsonContent(ref="#/components/schemas/SendVerificationLinkSuccessResponseVirtual")
 *     ),
 *     @OA\Response(
 *         response=401,
 *         description="Unauthenticated",
 *         @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResponseVirtual")
 *     )
 * )
 */
class SendVerificationLinkEndpointVirtual
{
}
