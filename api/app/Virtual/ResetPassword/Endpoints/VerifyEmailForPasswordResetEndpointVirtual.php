<?php

namespace App\Virtual\ResetPassword\Endpoints;

/**
 * @OA\Post(
 *     path="reset-password/verify-email",
 *     operationId="verifyEmailForResetPassword",
 *     tags={"Authentication"},
 *     summary="Verify Email for Password Reset",
 *     description="Send a verification link to the provided email address to initiate the password reset process.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/VerifyEmailRequestVirtual")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Verification email sent successfully",
 *         @OA\JsonContent(ref="#/components/schemas/VerifyEmailSuccessResponseVirtual")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation errors",
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 schema=@OA\Schema(
 *                     oneOf={
 *                         @OA\Schema(ref="#/components/schemas/InvalidEmailFormatResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/EmailFieldRequiredResponseVirtual")
 *                     }
 *                 )
 *             )
 *         }
 *     )
 * )
 */
class VerifyEmailForPasswordResetEndpointVirtual
{
}
