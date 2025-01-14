<?php

namespace App\Virtual\User\Endpoints;

/**
 * @OA\Put(
 *      path="/user",
 *      operationId="updateUser",
 *      tags={"User"},
 *      summary="Update User Details",
 *      description="Updates the user's name or username. The user must be authenticated.",
 *      security={{"bearerAuth":{}}},
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequestVirtual")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="User updated successfully.",
 *          @OA\JsonContent(ref="#/components/schemas/UpdateUserSuccessResponseVirtual")
 *      ),
 *      @OA\Response(
 *          response=422,
 *          description="Validation errors",
 *          @OA\JsonContent(ref="#/components/schemas/UpdateUserValidationErrorResponseVirtual")
 *      ),
 *      @OA\Response(
 *          response=401,
 *          description="Unauthenticated",
 *          @OA\JsonContent(ref="#/components/schemas/UnauthenticatedResponseVirtual")
 *      )
 * )
 */
class UpdateUserEndpointVirtual
{
}
