<?php

namespace App\Virtual\Register\Responses;

/**
 * @OA\Schema(
 *      title="User Created Successfully",
 *      description="Successful registration response with user details and tokens",
 *      type="object"
 * )
 */
class RegisterSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Success message",
     *      example="User created successfully."
     * )
     * @var string
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Data",
     *      description="User data object",
     *      @OA\Property(
     *          property="uuid",
     *          description="User UUID",
     *          example="4e2e178e-3404-4735-8e55-2a7203b3bacc"
     *      ),
     *      @OA\Property(
     *          property="name",
     *          description="User full name",
     *          example="John Doe"
     *      ),
     *      @OA\Property(
     *          property="email",
     *          description="User email",
     *          example="jhon@doe2.com"
     *      ),
     *      @OA\Property(
     *          property="username",
     *          description="User username",
     *          example="jhondoe2"
     *      ),
     *      @OA\Property(
     *          property="created_at",
     *          description="Creation timestamp",
     *          example="2025-01-06T00:22:53.000000Z"
     *      )
     * )
     */
    public object $data;

    /**
     * @OA\Property(
     *      title="Access Token",
     *      description="JWT access token for the user",
     *      example="40|0Enp6LH3GTo2lRAZ1StZKLCgnoQFEqOrrdp1KTeC3a7d4cec"
     * )
     */
    public string $access_token;

    /**
     * @OA\Property(
     *      title="Refresh Token",
     *      description="JWT refresh token for the user",
     *      example="308616826d0f7a16c23436f048f0c19d81d658e7949e252571d332787d7ab95f"
     * )
     */
    public string $refresh_token;

    /**
     * @OA\Property(
     *      title="Expires At",
     *      description="Access token expiration date",
     *      example="2025-01-05T22:22:54.137246Z"
     * )
     */
    public string $expires_at;
}
