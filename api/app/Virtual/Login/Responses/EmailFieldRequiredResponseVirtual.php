<?php

namespace App\Virtual\Login\Responses;

/**
 * @OA\Schema(
 *      title="Email Field Required Response",
 *      description="Response returned when the email field is missing.",
 *      type="object"
 * )
 */
class EmailFieldRequiredResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The email field is required."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Detailed validation errors",
     *      @OA\Property(
     *          property="email",
     *          type="array",
     *          @OA\Items(type="string", example="The email field is required.")
     *      )
     * )
     */
    public object $errors;
}
