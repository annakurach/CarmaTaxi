<?php

namespace App\Http\Requests\Post;

use App\Dto\Post\PostUpdateDto;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema (
 *     type="object",
 *     title="Post update request",
 *     required={"title", "text"},
 *     schema="PostUpdateRequest",
 *     @OA\Property(
 *         type="string",
 *         property="title",
 *         title="Post title",
 *         example="Post title example",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="text",
 *         title="Text of post",
 *         example="Lorem ipsum dolor sit amet, consectetur adipiscing elit.",
 *     ),
 * )
 */
class PostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'text' => ['required', 'string'],
        ];
    }

    /**
     * @return PostUpdateDto
     */
    public function getDto(): PostUpdateDto
    {
        return (new PostUpdateDto())
            ->setTitle($this->get('title'))
            ->setText($this->get('text'));
    }
}
