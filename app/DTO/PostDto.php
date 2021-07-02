<?php


namespace App\DTO;

use App\Collections\TagCollection;
use App\Post;
use App\Services\PostService;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\DataTransferObject;

class PostDto extends DataTransferObject
{
    public ?int $id;
    public int $user_id;
    public string $title;
    public string $excerpt;
    public string $content;
    public ?string $image;
    public ?UploadedFile $imageFile;
    public ?string $published_at;
    public TagCollection $tags;
    public CategoryDto $category;



    public function getTagIds()
    {
        $tag_ids = [];
        foreach ($this->tags as $tag) {
            $tag_ids[] = $tag->id;
        }
        return $tag_ids;
    }

    public function getCategoryId()
    {
        return $this->category->id;
    }

    public function getAuthorName()
    {
        return Post::findOrFail($this->id)->authorName;
        // return PostService::getAuthorName($this->id);
    }
    
    // public function __construct(
    //     ?int $id,
    //     int $user_id,
    //     string $title,
    //     string $excerpt,
    //     string $content,
    //     string $image,
    //     CategoryDto $categoryDto,
    //     Collection $tagDtoCollection,
    //     string $published_at
    // ) {
    //     $this->id = $id;
    //     $this->user_id = $user_id;
    //     $this->title = $title;
    //     $this->excerpt = $excerpt;
    //     $this->content = $content;
    //     $this->image = $image;
    //     $this->categoryDto = $categoryDto;
    //     $this->tagDtoCollection = $tagDtoCollection;
    //     $this->published_at = $published_at;   
    // }


    // public function toArray() :array
    // {

    //     $tag_ids = [];
    //     foreach ($this->tagDtoCollection as $tagDto) {
    //         $tag_ids[] = $tagDto->id;
    //     }


    //     return [
    //         'user_id' => $this->user_id,
    //         'title' => $this->title,
    //         'excerpt' => $this->excerpt,
    //         'content' => $this->content,
    //         'image' => $this->image,
    //         'category_id' => $this->categoryDto->id,
    //         'published_at' => $this->published_at,
    //         'tag_ids' => $tag_ids,

    //     ];
    // }


}



