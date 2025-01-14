<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="UpdateUserValidationErrorResponse",
 *      description="Response for validation errors when updating user details",
 *      type="object"
 * )
 */
class UpdateUserValidationErrorResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The name field is required when username is not present. (and 1 more error)"
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Errors",
     *      description="Validation errors",
     *      type="object",
     *      @OA\Property(
     *          property="name",
     *          type="array",
     *          @OA\Items(
     *              type="string",
     *              example="The name field is required when username is not present."
     *          )
     *      ),
     *      @OA\Property(
     *          property="username",
     *          type="array",
     *          @OA\Items(
     *              type="string",
     *              example="The username field is required when name is not present."
     *          )
     *      )
     * )
     */
    public object $errors;
}
