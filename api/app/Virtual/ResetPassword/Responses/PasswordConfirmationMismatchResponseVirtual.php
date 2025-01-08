<?php

namespace App\Virtual\ResetPassword\Responses;

/**
 * @OA\Schema(
 *     title="Password Confirmation Mismatch Response",
 *     description="Response when the password confirmation does not match",
 *     type="object"
 * )
 */
class PasswordConfirmationMismatchResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     example="The password field confirmation does not match."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *     title="Errors",
     *     description="Validation errors",
     *     type="object",
     *     @OA\Property(
     *         property="password",
     *         type="array",
     *         @OA\Items(
     *             type="string",
     *             example="The password field confirmation does not match."
     *         )
     *     )
     * )
     */
    public object $errors;
}
