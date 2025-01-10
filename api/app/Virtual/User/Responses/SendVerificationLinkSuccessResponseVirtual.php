<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="Send Verification Link Success Response",
 *      description="Successful response when the verification email is sent",
 *      type="object"
 * )
 */
class SendVerificationLinkSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      example="Email sent successfully. Check your inbox for further explanation."
     * )
     */
    public string $message;
}
