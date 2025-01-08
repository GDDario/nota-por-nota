<?php

namespace App\Virtual\Generic\Responses;

/**
 * @OA\Schema(
 *     title="Email Field Required Response",
 *     description="Response for missing email field",
 *     type="object"
 * )
 */
class EmailFieldRequiredResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     example="The email field is required."
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
     *             example="The email field is required."
     *         )
     *     )
     * )
     */
    public object $errors;
}
