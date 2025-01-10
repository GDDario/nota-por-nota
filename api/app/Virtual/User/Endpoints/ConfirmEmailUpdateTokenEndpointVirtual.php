<?php

namespace App\Virtual\User\Endpoints;

/**
 * @OA\Post(
 *      path="user/update-email/confirm-token",
 *      operationId="confirmEmailUpdateToken",
 *      tags={"User"},
 *      summary="Confirm Email Update Token",
 *      description="Validates the token for confirming an email update.",
 *      @OA\RequestBody(
 *          required=true,
 *          @OA\JsonContent(ref="#/components/schemas/ConfirmEmailTokenRequestVirtual")
 *      ),
 *      @OA\Response(
 *          response=200,
 *          description="Token confirmed successfully.",
 *          @OA\JsonContent(ref="#/components/schemas/ConfirmEmailTokenSuccessResponseVirtual")
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
 *          @OA\JsonContent(ref="#/components/schemas/TokenFieldRequiredResponseVirtual")
 *      )
 * )
 */
class ConfirmEmailUpdateTokenEndpointVirtual
{
}
