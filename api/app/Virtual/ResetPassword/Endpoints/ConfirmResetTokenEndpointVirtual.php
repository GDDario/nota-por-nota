<?php

namespace App\Virtual\ResetPassword\Endpoints;

/**
 * @OA\Post(
 *     path="reset-password/confirm-token",
 *     operationId="confirmResetToken",
 *     tags={"Password Reset"},
 *     summary="Confirm Reset Token",
 *     description="Confirm the provided token for resetting the password.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/ConfirmResetTokenRequestVirtual")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Token confirmed successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ConfirmResetTokenSuccessResponseVirtual")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation errors",
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 schema=@OA\Schema(
 *                     oneOf={
 *                         @OA\Schema(ref="#/components/schemas/InvalidResetTokenResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/ExpiredResetTokenResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/TokenFieldRequiredResponseVirtual")
 *                     }
 *                 )
 *             )
 *         }
 *     )
 * )
 */
class ConfirmResetTokenEndpointVirtual
{
}
