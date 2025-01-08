<?php

namespace App\Virtual\ResetPassword\Requests;

/**
 * @OA\Schema(
 *     title="Confirm Reset Token Request",
 *     description="Request body for confirming the reset password token",
 *     type="object",
 *     required={"token"}
 * )
 */
class ConfirmResetTokenRequestVirtual
{
    /**
     * @OA\Property(
     *     title="Token",
     *     description="The token provided to confirm password reset",
     *     example="Gb3I0Oqmbpohr6Pg81EzK8VQQxguRLhM4gWzk7v6bGot5OEk4yqMvjgwu5CPaiLE7tm3D5Gw852zf4SlO0GBrc11jm1242rtO4DO"
     * )
     */
    public string $token;
}
