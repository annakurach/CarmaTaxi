<?php

namespace App\Services\ApiToken;

use App\Dto\Token\TokenStoreDto;
use App\Dto\User\UserTokenDto;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class ApiTokenServiceService implements TokenServiceInterface
{
    public function __construct(private UserServiceInterface $userService)
    {
    }

    /**
     * @param TokenStoreDto $dto
     * @return UserTokenDto|false
     */
    public function store(TokenStoreDto $dto): UserTokenDto|false
    {
        $user = User::where('email', $dto->getEmail())->first();
        if (!$user || !Hash::check($dto->getPassword(), $user->password)) {
            return false;
        }

        return $this->userService->createApiToken($user);
    }
}
