<?php

namespace App\Http\Requests\Token;

use App\Dto\Token\TokenStoreDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

/**
 * @OA\Schema (
 *     type="object",
 *     title="API token store request",
 *     required={"email", "password"},
 *     schema="ApiTokenStoreRequest",
 *     @OA\Property(
 *         type="string",
 *         property="email",
 *         title="Email",
 *         example="user@email.com",
 *     ),
 *     @OA\Property(
 *         type="string",
 *         property="password",
 *         title="Password",
 *         example="password",
 *     ),
 * )
 */
class ApiTokenStoreRequest extends FormRequest
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
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'string', Password::min(8), 'max:255'],
        ];
    }

    /**
     * @return TokenStoreDto
     */
    public function getDto(): TokenStoreDto
    {
        return (new TokenStoreDto())
            ->setEmail($this->get('email'))
            ->setPassword($this->get('password'));
    }
}
