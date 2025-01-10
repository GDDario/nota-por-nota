<?php

namespace App\Virtual\User\Requests;

/**
 * @OA\Schema(
 *      title="Confirm Email Token Request",
 *      description="Request body for confirming email token",
 *      type="object",
 *      required={"token"}
 * )
 */
class ConfirmEmailTokenRequestVirtual
{
    /**
     * @OA\Property(
     *      title="Token",
     *      description="The token to confirm the email update",
     *      example="9E8YWlQionBHFAr4M27q5SpzWwyXANWdLbbmlugLI9L6ooxQ3HCPvaLoNtNYomB78gnGokmJr5UuytNs21w3CRimWakDtBnY6pAM"
     * )
     */
    public string $token;
}
