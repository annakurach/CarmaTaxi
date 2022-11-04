<?php

namespace App\Services\User;

use App\Dto\User\UserTokenDto;
use App\Models\User;

interface UserServiceInterface
{
    /**
     * @param User $user
     * @return UserTokenDto
     */
    public function createApiToken(User $user): UserTokenDto;
}
