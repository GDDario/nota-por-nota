<?php

namespace App\Virtual\ResetPassword\Responses;

/**
 * @OA\Schema(
 *     title="Confirm Reset Token Success Response",
 *     description="Response when the reset password token is confirmed successfully",
 *     type="object"
 * )
 */
class ConfirmResetTokenSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Success message",
     *     example="Token confirmed successfully."
     * )
     * @var string
     */
    public string $message;
}
