<?php

namespace App\Virtual\ResetPassword\Responses;

/**
 * @OA\Schema(
 *     title="Verify Email Success Response",
 *     description="Response when the email verification link is sent successfully",
 *     type="object"
 * )
 */
class VerifyEmailSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Success message",
     *     example="If the email exists, we will send a verification link to you continue the reset process."
     * )
     */
    public string $message;
}
