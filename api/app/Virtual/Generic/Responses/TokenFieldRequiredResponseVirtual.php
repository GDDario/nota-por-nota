<?php

namespace App\Virtual\Generic\Responses;

/**
 * @OA\Schema(
 *     title="Token Field Required Response",
 *     description="Response when the token field is missing",
 *     type="object"
 * )
 */
class TokenFieldRequiredResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Message",
     *     description="Error message",
     *     example="The token field is required."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *     title="Errors",
     *     description="Validation errors",
     *     type="object",
     *     @OA\Property(
     *         property="token",
     *         type="array",
     *         @OA\Items(
     *             type="string",
     *             example="The token field is required."
     *         )
     *     )
     * )
     */
    public object $errors;
}
