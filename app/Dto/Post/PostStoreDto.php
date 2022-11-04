<?php

namespace App\Dto\Post;

class PostStoreDto
{
    /**
     * @var string
     */
    private string $title;

    /**
     * @var string
     */
    private string $text;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return PostStoreDto
     */
    public function setTitle(string $title): PostStoreDto
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getText(): string
    {
        return $this->text;
    }

    /**
     * @param string $text
     * @return PostStoreDto
     */
    public function setText(string $text): PostStoreDto
    {
        $this->text = $text;
        return $this;
    }
}
