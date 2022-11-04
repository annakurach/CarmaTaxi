<?php

namespace App\Services\Post;

use App\Dto\Post\PostStoreDto;
use App\Dto\Post\PostUpdateDto;
use App\Models\Post;
use App\Models\User;

interface PostServiceInterface
{
    /**
     * @param User $user
     * @param PostStoreDto $dto
     * @return Post
     */
    public function create(User $user, PostStoreDto $dto): Post;

    /**
     * @param Post $post
     * @param PostUpdateDto $dto
     * @return Post
     */
    public function update(Post $post, PostUpdateDto $dto): Post;

    /**
     * @param Post $post
     * @return void
     */
    public function delete(Post $post): void;
}
