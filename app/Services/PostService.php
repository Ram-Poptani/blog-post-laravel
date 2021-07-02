<?php


namespace App\Services;

use App\Caster\PostCollectionCaster;
use App\Caster\TagCollectionCaster;
use App\Category;
use App\DTO\CategoryDto;
use App\DTO\PostDto;
use App\DTO\TagDto;
use App\Post;
use App\Tag;
use App\User;

use function GuzzleHttp\Promise\all;

class PostService
{



    public function index()
    {
        
        if (!auth()->user()->isAdmin()) {
            // $posts = $this->currentUserPosts(false);
            $posts = Post::withoutTrashed()->where('user_id', auth()->id());

        }else {
            $posts =  Post::with(['tags', 'category'])->get();
        }

        // makeDtoCollection($posts);
        return (new PostCollectionCaster())->cast($posts->toArray());
        
    }





    public function create(PostDto $postDto)
    {

        // Wanna derrive some more attributes? You can derrive'em here...

        // dd($postDto->toArray());


        Post::persistPost($postDto);   
    }

    public function update(PostDto $postDto, Post $post)
    {
        

        $post->updatePost($postDto);

    }



    public static function getAuthorName($id)
    {
        // dd(Post::findOrFail($id)->author->name);
        return Post::findOrFail($id)->author->name;
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
