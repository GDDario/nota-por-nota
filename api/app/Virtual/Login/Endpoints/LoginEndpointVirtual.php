<?php

namespace App\Virtual\Login\Endpoints;

/**
 * @OA\Post(
 *     path="login",
 *     operationId="login",
 *     tags={"Authentication"},
 *     summary="Login",
 *     description="Login with email and password.",
 *     @OA\Parameter(
 *         name="accept",
 *         in="header",
 *         description="Accept header",
 *         required=true,
 *         @OA\Schema(type="string"),
 *         example="application/json"
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(ref="#/components/schemas/LoginRequestVirtual")
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Successful login",
 *         @OA\JsonContent(ref="#/components/schemas/LoginSuccessResponseVirtual")
 *     ),
 *     @OA\Response(
 *          response=422,
 *          description="Validation error",
 *          content={
 *              @OA\MediaType(
 *                  mediaType="application/json",
 *                  schema=@OA\Schema(
 *                      oneOf={
 *                          @OA\Schema(ref="#/components/schemas/EmailFieldRequiredResponseVirtual"),
 *                          @OA\Schema(ref="#/components/schemas/InvalidEmailFormatResponseVirtual"),
 *                          @OA\Schema(ref="#/components/schemas/PasswordFieldRequiredResponseVirtual")
 *                      }
 *                  )
 *              )
 *          }
 *      ),
 *      @OA\Response(
 *          response=400,
 *          description="Generic error",
 *          @OA\JsonContent(ref="#/components/schemas/InvalidCredentialsResponseVirtual")
 *      )
 * )
 */
class LoginEndpointVirtual
{
}
