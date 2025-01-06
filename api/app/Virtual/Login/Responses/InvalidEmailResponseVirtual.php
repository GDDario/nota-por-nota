<?php

namespace App\Virtual\Login\Responses;

/**
 * @OA\Schema(
 *      title="Invalid Email Response",
 *      description="Response returned when the selected email is invalid.",
 *      type="object"
 * )
 */
class InvalidEmailResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The selected email is invalid."
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
     *          @OA\Items(type="string", example="The selected email is invalid.")
     *      )
     * )
     */
    public object $errors;
}
