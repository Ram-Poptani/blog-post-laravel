<?php


namespace App\Services;

use App\DTO\PostDto;
use App\Post;

class PostService
{
    public function create(PostDto $postDto)
    {

        // Wanna derrive some more attributes? You can derrive'em here...


        Post::persistPost($postDto);   
    }
}
