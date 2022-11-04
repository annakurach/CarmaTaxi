<?php

namespace App\Dto\Post;

class PostUpdateDto
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
     * @return PostUpdateDto
     */
    public function setTitle(string $title): PostUpdateDto
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
     * @return PostUpdateDto
     */
    public function setText(string $text): PostUpdateDto
    {
        $this->text = $text;
        return $this;
    }
}
