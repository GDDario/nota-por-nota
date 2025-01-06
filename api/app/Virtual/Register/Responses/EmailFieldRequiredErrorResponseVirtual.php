<?php

namespace App\Virtual\Register\Responses;

/**
 * @OA\Schema(
 *      title="Email Field Required Error",
 *      description="Error response when email field is missing",
 *      type="object"
 * )
 */
class EmailFieldRequiredErrorResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The email field is required."
     * )
     * @var string
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Error details",
     *      @OA\Property(
     *          property="email",
     *          description="Email error",
     *          example="The email field is required."
     *      )
     * )
     */
    public object $errors;
}
