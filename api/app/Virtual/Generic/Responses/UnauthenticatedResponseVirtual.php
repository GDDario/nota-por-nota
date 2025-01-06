<?php

namespace App\Virtual\Generic\Responses;

/**
 * @OA\Schema(
 *      title="Unauthenticated Response",
 *      description="Error response for unauthenticated requests",
 *      type="object"
 * )
 */
class UnauthenticatedResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Error message",
     *      example="Unauthenticated."
     * )
     */
    public string $message;
}
