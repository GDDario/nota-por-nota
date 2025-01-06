<?php

namespace App\Virtual\Register\Responses;

/**
 * @OA\Schema(
 *      title="Password Confirmation Error",
 *      description="Error response when password confirmation does not match",
 *      type="object"
 * )
 */
class PasswordConfirmationErrorResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The password field confirmation does not match."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Error details",
     *      @OA\Property(
     *          property="password",
     *          description="Password confirmation error",
     *          example="The password field confirmation does not match."
     *      )
     * )
     */
    public object $errors;
}
