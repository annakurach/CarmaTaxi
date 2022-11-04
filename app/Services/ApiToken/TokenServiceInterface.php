<?php

namespace App\Services\ApiToken;

use App\Dto\Token\TokenStoreDto;
use App\Dto\User\UserTokenDto;

interface TokenServiceInterface
{
    /**
     * @param TokenStoreDto $dto
     * @return UserTokenDto|false
     */
    public function store(TokenStoreDto $dto): UserTokenDto|false;
}
