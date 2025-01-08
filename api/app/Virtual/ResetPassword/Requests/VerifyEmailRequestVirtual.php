<?php

namespace App\Virtual\ResetPassword\Requests;

/**
 * @OA\Schema(
 *     title="Verify Email Request",
 *     description="Request body for verifying email for password reset",
 *     type="object",
 *     required={"email"}
 * )
 */
class VerifyEmailRequestVirtual
{
    /**
     * @OA\Property(
     *     title="Email",
     *     description="Email address of the user requesting password reset",
     *     example="john@doe.com"
     * )
     */
    public string $email;
}
