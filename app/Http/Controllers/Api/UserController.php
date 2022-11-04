<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return UserResource
     *
     * @OA\Get(
     *     path="/api/account",
     *     summary="Get current user's account",
     *     tags={"User"},
     *     security={{"bearearAuth"={}}},
     *     description="Get current user's account",
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(ref="#/components/schemas/UserResource")
     *     ),
     * )
     */
    public function show(Request $request): UserResource
    {
        return new UserResource($request->user());
    }
}
