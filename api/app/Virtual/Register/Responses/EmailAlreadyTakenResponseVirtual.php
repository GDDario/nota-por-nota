<?php

namespace App\Virtual\Register\Responses;

/**
 * @OA\Schema(
 *      title="Email Already Taken Error",
 *      description="Error response when the email is already taken",
 *      type="object"
 * )
 */
class EmailAlreadyTakenResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The email has already been taken."
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
     *          example="The email has already been taken."
     *      )
     * )
     */
    public object $errors;
}
