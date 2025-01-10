<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="EmailMatchErrorResponse",
 *      description="Response when email and confirmation do not match",
 *      type="object"
 * )
 */
class EmailMatchErrorResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The email field confirmation does not match."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Detailed errors",
     *      type="object",
     *      @OA\Property(
     *          property="email",
     *          type="array",
     *          @OA\Items(
     *              type="string",
     *              example="The email field confirmation does not match."
     *          )
     *      )
     * )
     */
    public array $errors;
}
