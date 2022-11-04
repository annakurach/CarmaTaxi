<?php

namespace App\Dto\Token;

class TokenStoreDto
{
    /**
     * @var string
     */
    private string $email;

    /**
     * @var string
     */
    private string $password;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return TokenStoreDto
     */
    public function setEmail(string $email): TokenStoreDto
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return TokenStoreDto
     */
    public function setPassword(string $password): TokenStoreDto
    {
        $this->password = $password;
        return $this;
    }
}
