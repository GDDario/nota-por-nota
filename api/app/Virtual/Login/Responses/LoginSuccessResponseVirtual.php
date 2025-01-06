<?php

namespace App\Virtual\Login\Responses;

/**
 * @OA\Schema(
 *      title="Login successful response",
 *      description="Successful JSON response login with user and token information.",
 *      type="object"
 * )
 */
class LoginSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Success message",
     *      example="Successfully logged in."
     * )
     */
    public string $message;

    /**
     * @OA\Property(
     *      title="Data",
     *      description="Data containing user information and tokens",
     *      @OA\Property(
     *          property="user",
     *          type="object",
     *          @OA\Property(property="uuid", type="string", example="e3643a0e-ff80-4617-b976-633ceb54798b"),
     *          @OA\Property(property="name", type="string", example="John Doe"),
     *          @OA\Property(property="email", type="string", example="jhon@doe.com"),
     *          @OA\Property(property="username", type="string", example="jhondoe"),
     *          @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-03T03:01:48.000000Z"),
     *          @OA\Property(property="updated_at", type="string", format="date-time", example="2025-01-03T03:01:48.000000Z")
     *      ),
     *      @OA\Property(
     *          property="access_token",
     *          type="string",
     *          example="39|MYVmLxKl0WlKHlguSLlXxiAX6axPhaL2KRs1qYT107720ec2"
     *      ),
     *      @OA\Property(
     *          property="refresh_token",
     *          type="string",
     *          example="5fb948636531dbb16adc238e61c7b234acca2019b483f80d943b6b88bbc948b9"
     *      ),
     *      @OA\Property(
     *          property="expires_at",
     *          type="string",
     *          format="date-time",
     *          example="2025-01-05T21:43:32.861117Z"
     *      )
     * )
     */
    public object $data;
}
