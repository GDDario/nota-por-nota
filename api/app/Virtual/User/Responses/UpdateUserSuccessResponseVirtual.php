<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="UpdateUserSuccessResponse",
 *      description="Response for successful user update",
 *      type="object"
 * )
 */
class UpdateUserSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Data",
     *      description="Response data",
     *      @OA\Property(
     *          property="user",
     *          type="object",
     *          @OA\Property(property="uuid", type="string", example="4575a824-8014-3712-853a-8f8b32351610"),
     *          @OA\Property(property="name", type="string", example="John Doe"),
     *          @OA\Property(property="email", type="string", example="john@doe.com"),
     *          @OA\Property(property="username", type="string", example="Jhondoe"),
     *          @OA\Property(property="picture", type="string", example="2025-01-13 22:53:44"),
     *          @OA\Property(property="created_at", type="string", format="date-time", example="2025-01-14T01:37:36.000000Z"),
     *          @OA\Property(property="updated_at", type="string", format="date-time", nullable=true, example=null)
     *      )
     * )
     */
    public object $data;
}
