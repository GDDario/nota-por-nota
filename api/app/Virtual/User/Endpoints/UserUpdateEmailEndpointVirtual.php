<?php

namespace App\Virtual\User\Endpoints;

/**
 * @OA\Put(
 *      path="user/update-email",
 *      operationId="updateEmail",
 *      tags={"User"},
 *      summary="Update User Email",
 *      description="Updates the user's email after validating the provided token.",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/UpdateEmailRequestVirtual")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Email updated successfully.",
 *          @OA\JsonContent(ref="#/components/schemas/UpdateEmailSuccessResponseVirtual")
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Token errors",
 *          @OA\JsonContent(
 *              oneOf={
 *                  @OA\Schema(ref="#/components/schemas/InvalidTokenResponseVirtual"),
 *                  @OA\Schema(ref="#/components/schemas/ExpiredTokenResponseVirtual")
 *              }
 *          )
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation errors",
 *          @OA\JsonContent(
 *              oneOf={
 *                  @OA\Schema(ref="#/components/schemas/EmailFieldRequiredResponseVirtual"),
 *                  @OA\Schema(ref="#/components/schemas/EmailMatchErrorResponseVirtual")
 *              }
 *          )
 *      )
 * )
 */
class UserUpdateEmailEndpointVirtual
{
}
