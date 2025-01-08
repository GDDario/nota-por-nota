<?php

namespace App\Virtual\Generic\Responses;

/**
 * @OA\Schema(
 *      title="Password Field Required Response",
 *      description="Response returned when the password field is missing.",
 *      type="object"
 * )
 */
class PasswordFieldRequiredResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The password field is required."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Detailed validation errors",
     *      @OA\Property(
     *          property="password",
     *          type="array",
     *          @OA\Items(type="string", example="The password field is required.")
     *      )
     * )
     */
    public object $errors;
}
