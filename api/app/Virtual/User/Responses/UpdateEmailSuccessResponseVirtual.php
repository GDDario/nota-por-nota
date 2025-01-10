<?php

namespace App\Virtual\User\Responses;

/**
 * @OA\Schema(
 *      title="UpdateEmailSuccessResponse",
 *      description="Response for successful email update",
 *      type="object"
 * )
 */
class UpdateEmailSuccessResponseVirtual
{
    /**
     * @OA\Property(
     *      title="Message",
     *      description="Success message",
     *      example="Email updated successfully!"
     * )
     */
    public string $message;
}
