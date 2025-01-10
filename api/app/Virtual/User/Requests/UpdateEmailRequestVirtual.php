<?php

namespace App\Virtual\User\Requests;

/**
 * @OA\Schema(
 *      title="UpdateEmailRequest",
 *      description="Request body for updating email",
 *      type="object",
 *      required={"token", "email", "email_confirmation"}
 * )
 */
class UpdateEmailRequestVirtual
{
    /**
     * @OA\Property(
     *      title="Token",
     *      description="Token to validate email update",
     *      example="SFsWIVQbT8QDiXQyddIPRiYrj900EHpsPpnhGj3R6VmdtZMiV77GBQANaEHgH4hjl2k8kRgPdgE4MOGMoJAJlBQlOt45AJ7XhA3v"
     * )
     */
    public string $token;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="New email address",
     *      format="email",
     *      example="new_john@doe.com"
     * )
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="Email Confirmation",
     *      description="Confirmation of the new email address",
     *      format="email",
     *      example="new_john@doe.com"
     * )
     */
    public string $email_confirmation;
}
