<?php

namespace App\Http\Resources\User;

use App\Models\User;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property User $resource
 *
 * @OA\Schema(
 *     title="User Resource",
 *     type="object",
 *     schema="UserResource",
 *
 *     @OA\Property(
 *         type="integer",
 *         property="id",
 *         title="ID",
 *         example="1",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="name",
 *         title="Name",
 *         example="John",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="email",
 *         title="Email",
 *         example="user@email.com",
 *     ),
 *     @OA\Property(
 *         type="bool",
 *         property="is_email_verified",
 *         title="Is email verified",
 *         example="true",
 *     ),
 * )
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|\JsonSerializable
     */
    public function toArray($request): array|\JsonSerializable|Arrayable
    {
        return [
            'id' => $this->resource->id,
            'name' => $this->resource->name,
            'email' => $this->resource->email,
            'is_email_verified' => (bool)$this->resource->email_verified_at,
        ];
    }
}
