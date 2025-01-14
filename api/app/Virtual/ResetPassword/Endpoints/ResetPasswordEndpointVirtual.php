<?php

namespace App\Virtual\ResetPassword\Endpoints;

/**
 * @OA\Put(
 *     path="reset-password",
 *     operationId="resetPassword",
 *     tags={"Authentication"},
 *     summary="Reset Password",
 *     description="Reset the user password with a valid token.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/ResetPasswordRequestVirtual")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Password reset successfully",
 *         @OA\JsonContent(ref="#/components/schemas/ResetPasswordSuccessResponseVirtual")
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
 *                         @OA\Schema(ref="#/components/schemas/TokenFieldRequiredResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/PasswordFieldRequiredResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/PasswordConfirmationMismatchResponseVirtual")
 *                     }
 *                 )
 *             )
 *         }
 *     )
 * )
 */
class ResetPasswordEndpointVirtual
{
}
