<?php

namespace App\Virtual\Register\Endpoints;

/**
 * @OA\Post(
 *     path="register",
 *     operationId="register",
 *     tags={"Authentication"},
 *     summary="Register a new user",
 *     description="User registration endpoint with name, email, username, and password.",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/RegisterRequestVirtual")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="User created successfully",
 *         @OA\JsonContent(ref="#/components/schemas/RegisterSuccessResponseVirtual")
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Validation error",
 *         content={
 *             @OA\MediaType(
 *                 mediaType="application/json",
 *                 schema=@OA\Schema(
 *                     allOf={
 *                         @OA\Schema(ref="#/components/schemas/EmailAlreadyTakenResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/UsernameAlreadyTakenResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/PasswordConfirmationErrorResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/NameFieldRequiredErrorResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/EmailFieldRequiredErrorResponseVirtual"),
 *                         @OA\Schema(ref="#/components/schemas/UsernameFieldRequiredErrorResponseVirtual")
 *                     }
 *                 )
 *             )
 *         }
 *     )
 * )
 */
class RegisterEndpointVirtual
{
}
