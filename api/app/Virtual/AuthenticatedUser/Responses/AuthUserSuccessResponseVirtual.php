<?php

namespace App\Virtual\AuthenticatedUser\Responses;

/**
 * @OA\Schema(
 *      title="Auth User Success Response",
 *      description="Response containing authenticated user data",
 *      type="object"
 * )
 */
class AuthUserSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="The authenticated user's information",
     *     type="object",
     *     @OA\Property(
     *         property="uuid",
     *         title="UUID",
     *         description="Unique identifier of the user",
     *         example="e3643a0e-ff80-4617-b976-633ceb54798b"
     *     ),
     *     @OA\Property(
     *         property="name",
     *         title="Name",
     *         description="Name of the authenticated user",
     *         example="John Doe"
     *     ),
     *     @OA\Property(
     *         property="email",
     *         title="Email",
     *         description="Email of the authenticated user",
     *         example="jhon@doe.com"
     *     ),
     *     @OA\Property(
     *         property="username",
     *         title="Username",
     *         description="Username of the authenticated user",
     *         example="jhondoe"
     *     ),
     *     @OA\Property(
     *         property="created_at",
     *         title="Created At",
     *         description="Date and time when the user was created",
     *         example="2025-01-03T03:01:48.000000Z"
     *     ),
     *     @OA\Property(
     *         property="updated_at",
     *         title="Updated At",
     *         description="Date and time when the user was last updated",
     *         example="2025-01-03T03:01:48.000000Z"
     *     )
     * )
     */
    public object $data;
}
