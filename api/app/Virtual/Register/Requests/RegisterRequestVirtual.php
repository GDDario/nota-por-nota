<?php

namespace App\Virtual\Register\Requests;

/**
 * @OA\Schema(
 *      title="Register Request",
 *      description="Request body for user registration",
 *      type="object",
 *      required={"name", "email", "username", "password", "password_confirmation"}
 * )
 */
class RegisterRequestVirtual
{
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Full name of the user",
     *      example="John Doe"
     * )
     */
    public string $name;

    /**
     * @OA\Property(
     *      title="Email",
     *      description="Email address of the user",
     *      example="jhon@doe2.com"
     * )
     */
    public string $email;

    /**
     * @OA\Property(
     *      title="Username",
     *      description="Username of the user",
     *      example="jhondoe2"
     * )
     */
    public string $username;

    /**
     * @OA\Property(
     *      title="Password",
     *      description="Password for the user",
     *      example="password"
     * )
     */
    public string $password;

    /**
     * @OA\Property(
     *      title="Password Confirmation",
     *      description="Password confirmation field",
     *      example="password"
     * )
     */
    public string $password_confirmation;
}
