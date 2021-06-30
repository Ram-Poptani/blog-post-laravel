<?php


namespace App\Services;

use App\Category;
use App\DTO\CategoryDto;
use App\DTO\PostDto;
use App\DTO\TagDto;
use App\Post;
use App\Tag;

use function GuzzleHttp\Promise\all;

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

    public function getPosts($trashed = true)
    {
        if ($trashed) {
            return Post::paginate(5);
        }

        return Post::withoutTrashed()->paginate(5);
    }

    public function getPostsCount()
    {
        return Post::all()->count();
    }

    public function currentUserPosts($trashed = true)
    {
        if ($trashed) {
            return Post::all()->where('user_id', auth()->id())->paginate(5);
        }

        return Post::withoutTrashed()->where('user_id', auth()->id())->paginate(5);
    }

    public function updateImage(PostDto $postDto, $image)
    {
        $imageUrl = $image->store('posts');
        $post = Post::findOrFail($postDto->id);
        $post->deleteImage();
        $postDto->image = $imageUrl;
        return $postDto;
    }


    
    public function makeDto(Post $post)
    {
        $tagDtoCollection = collect();
        // dd($post->tags);
        foreach ($post->tags as $tag) {
            $tagDto = new TagDto($tag->id, $tag->name);
            $tagDtoCollection->push($tagDto);
        }


        $category_id = $post->category_id;
        $category = Category::findOrFail($category_id);
        $categoryDto = new CategoryDto($category_id, $category->name);

        $postDto = new PostDto(
            $post->id ?? null,
            auth()->user()->id,
            $post->title,
            $post->excerpt,
            $post->content,
            $post->image,
            $categoryDto,
            $tagDtoCollection,
            $post->published_at ?? now()
        );

        $postDto->author_name = $post->author->name;

        return $postDto;
    }

    
    public function makeDtoCollection($posts = [])
    {
        $postDtoCollection = collect();
       foreach ($posts as $post) {
            if ($post instanceof Post) {
                $postDtoCollection->push(
                    $this->makeDto($post)
                 );
            } else if ($post instanceof PostDto) {
                $postDtoCollection->push($post);
            }
       }
       return $postDtoCollection;
    }

    

}
