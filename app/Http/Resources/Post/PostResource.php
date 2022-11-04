<?php

namespace App\Http\Resources\Post;

use App\Http\Resources\User\UserResource;
use App\Models\Post;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Post $resource
 *
 * @OA\Schema(
 *     title="Post Resource",
 *     type="object",
 *     schema="PostResource",
 *
 *     @OA\Property(
 *         type="integer",
 *         property="id",
 *         title="ID",
 *         example="1",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="title",
 *         title="Post title",
 *         example="Post title",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="text",
 *         title="Post text",
 *         example="Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
 *     ),
 *     @OA\Property(
 *         type="object",
 *         property="user",
 *         title="User",
 *         ref="#/components/schemas/UserResource"
 *     ),
 * )
 */
class PostResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            'text' => $this->resource->text,
            'user' => new UserResource($this->resource->user)
        ];
    }
}
