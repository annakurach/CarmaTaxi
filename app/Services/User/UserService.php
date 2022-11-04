<?php

namespace App\Services\User;

use App\Dto\User\UserTokenDto;
use App\Models\User;

class UserService implements UserServiceInterface
{
    /**
     * @param User $user
     * @param string $name
     * @return UserTokenDto
     */
    public function createApiToken(User $user, string $name = 'app_token'): UserTokenDto
    {
        $token = $user->createToken($name);

        return (new UserTokenDto())
            ->setId($token->accessToken->id)
            ->setToken($token->plainTextToken)
            ->setUser($user);
    }
}
