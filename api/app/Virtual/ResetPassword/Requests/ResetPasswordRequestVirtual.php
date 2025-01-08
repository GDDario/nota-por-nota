<?php

namespace App\Virtual\ResetPassword\Requests;

/**
 * @OA\Schema(
 *     title="Reset Password Request",
 *     description="Request body for resetting the password",
 *     type="object",
 *     required={"token", "password", "password_confirmation"}
 * )
 */
class ResetPasswordRequestVirtual
{
    /**
     * @OA\Property(
     *     title="Token",
     *     description="The reset token",
     *     example="Gb3I0Oqmbpohr6Pg81EzK8VQQxguRLhM4gWzk7v6bGot5OEk4yqMvjgwu5CPaiLE7tm3D5Gw852zf4SlO0GBrc11jm1242rtO4DO"
     * )
     */
    public string $token;

    /**
     * @OA\Property(
     *     title="Password",
     *     description="The new password",
     *     example="password"
     * )
     */
    public string $password;

    /**
     * @OA\Property(
     *     title="Password Confirmation",
     *     description="Password confirmation",
     *     example="password"
     * )
     */
    public string $password_confirmation;
}
