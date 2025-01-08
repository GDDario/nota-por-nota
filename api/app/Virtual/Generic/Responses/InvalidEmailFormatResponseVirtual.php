<?php

namespace App\Virtual\Generic\Responses;

/**
 * @OA\Schema(
 *     title="Invalid Email Format Response",
 *     description="Response for invalid email format",
 *     type="object"
 * )
 */
class InvalidEmailFormatResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     example="The email field must be a valid email address."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *     title="Errors",
     *     description="Validation errors",
     *     type="object",
     *     @OA\Property(
     *         property="email",
     *         type="array",
     *         @OA\Items(
     *             type="string",
     *             example="The email field must be a valid email address."
     *         )
     *     )
     * )
     */
    public object $errors;
}
