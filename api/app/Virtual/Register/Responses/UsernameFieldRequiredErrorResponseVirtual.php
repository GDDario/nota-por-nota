<?php

namespace App\Virtual\Register\Responses;

/**
 * @OA\Schema(
 *      title="Username Field Required Error",
 *      description="Error response when username field is missing",
 *      type="object"
 * )
 */
class UsernameFieldRequiredErrorResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The username field is required."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Error details",
     *      @OA\Property(
     *          property="username",
     *          description="Username error",
     *          example="The username field is required."
     *      )
     * )
     */
    public object $errors;
}
