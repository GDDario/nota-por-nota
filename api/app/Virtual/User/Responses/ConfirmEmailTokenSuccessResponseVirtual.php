<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="Confirm Email Token Success Response",
 *      description="Response after successfully confirming the email token",
 *      type="object"
 * )
 */
class ConfirmEmailTokenSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Success message",
     *      example="Token confirmed successfully."
     * )
     */
    public string $message;
}
