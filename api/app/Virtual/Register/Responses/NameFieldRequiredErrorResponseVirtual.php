<?php

namespace App\Virtual\Register\Responses;

/**
 * @OA\Schema(
 *      title="Name Field Required Error",
 *      description="Error response when name field is missing",
 *      type="object"
 * )
 */
class NameFieldRequiredErrorResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The name field is required."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Error details",
     *      @OA\Property(
     *          property="name",
     *          description="Name error",
     *          example="The name field is required."
     *      )
     * )
     */
    public object $errors;
}
