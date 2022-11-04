<?php

namespace App\Services\Post;

use App\Dto\Post\PostStoreDto;
use App\Dto\Post\PostUpdateDto;
use App\Models\Post;
use App\Models\User;

class PostService implements PostServiceInterface
{
    /**
     * @param User $user
     * @param PostStoreDto $dto
     * @return Post
     */
    public function create(User $user, PostStoreDto $dto): Post
    {
        $post = new Post([
            'title' => $dto->getTitle(),
            'text' => $dto->getText(),
            'user_id' => $user->id,
        ]);
        $post->save();
        return $post;
    }

    /**
     * @param Post $post
     * @param PostUpdateDto $dto
     * @return Post
     */
    public function update(Post $post, PostUpdateDto $dto): Post
    {
        $post->title = $dto->getTitle();
        $post->text = $dto->getText();
        $post->save();

        return $post;
    }

    /**
     * @param Post $post
     * @return void
     */
    public function delete(Post $post): void
    {
        $post->delete();
    }
}
