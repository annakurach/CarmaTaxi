<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Token\ApiTokenStoreRequest;
use App\Services\ApiToken\TokenServiceInterface;
use Illuminate\Http\Response;

class ApiTokenController extends Controller
{
    /**
     * @param ApiTokenStoreRequest $request
     * @param TokenServiceInterface $tokenService
     * @return Response
     *
     * @OA\Post(
     *     path="/api/token",
     *     summary="Generate auth token",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(ref="#/components/schemas/ApiTokenStoreRequest")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Success",
     *         @OA\JsonContent(
     *              @OA\Property(
     *                     property="token",
     *                     title="Token",
     *                     type="string",
     *                     example="3|9WRihby8o9sAJyyIZGa6ioePh9ts2WzfrJMnyzEB",
     *                 )
     *         )
     *     ),
     *     @OA\Response(response=422, ref="#/components/responses/ValidationFailedResponse"),
     *     @OA\Response(response=400, ref="#/components/responses/BaseIncorrectRequestResponse"),
     * )
     */
    public function store(ApiTokenStoreRequest $request, TokenServiceInterface $tokenService): Response
    {
        $token = $tokenService->store($request->getDto());
        if (!$token) {
            return response([
                'message' => 'messages.user.incorrect_auth_credentials',
            ], Response::HTTP_BAD_REQUEST);
        } else {
            return response([
                'token' => $token->getToken(),
            ]);
        }
    }
}
