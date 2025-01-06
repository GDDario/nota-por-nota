<?php

namespace App\Virtual\Register\Responses;

/**
 * @OA\Schema(
 *      title="Username Already Taken Error",
 *      description="Error response when the username is already taken",
 *      type="object"
 * )
 */
class UsernameAlreadyTakenResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="The username has already been taken."
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
     *          example="The username has already been taken."
     *      )
     * )
     */
    public object $errors;
}
