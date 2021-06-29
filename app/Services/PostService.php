<?php


namespace App\Services;

use App\DTO\PostDto;
use App\Post;

class PostService
{
    public function create(PostDto $postDto)
    {

        // Wanna derrive some more attributes? You can derrive'em here...

        // dd($postDto->toArray());


        Post::persistPost($postDto);   
    }

    public function update(PostDto $postDto)
    {
        Post::updatePost($postDto);
    }

    public function updateImage(PostDto $postDto, $image)
    {
        $imageUrl = $image->store('posts');
        $post = Post::findOrFail($postDto->id);
        $post->deleteImage();
        $postDto->image = $imageUrl;
        return $postDto;
    }


}
