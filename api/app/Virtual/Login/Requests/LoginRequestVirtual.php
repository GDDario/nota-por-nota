<?php

namespace App\Virtual\Login\Requests;

/**
 * @OA\Schema(
 *      title="Login Request",
 *      description="Login body data",
 *      type="object",
 *      required={"email", "password"}
 * )
 */
class LoginRequestVirtual
{
    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email of the user",
     *      example="jhon@doe.com"
     * )
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password of the user",
     *      example="password"
     * )
     */
    public string $password;
}
