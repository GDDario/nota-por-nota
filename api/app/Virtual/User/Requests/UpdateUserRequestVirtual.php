<?php

namespace App\Virtual\User\Requests;

/**
 * @OA\Schema(
 *      title="UpdateUserRequest",
 *      description="Request body for updating user details",
 *      type="object",
 *      required={"name", "username"}
 * )
 */
class UpdateUserRequestVirtual
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="The updated name of the user",
     *      example="John Doe"
     * )
     */
    public string $name;

    /**
     * @OA\Property(
     *      title="Username",
     *      description="The updated username of the user",
     *      example="Jhondoe"
     * )
     */
    public string $username;
}
