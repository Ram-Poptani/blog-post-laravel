<?php


namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;

class PostDto
{
    public ?int $id;
    public int $user_id;
    public string $title;
    public string $excerpt;
    public string $content;
    public string $image;
    public Date $published_at;
    public Collection $tagDtoCollection;
    public CategoryDto $categoryDto;


    
    public function __construct(
        ?int $id,
        int $user_id,
        string $title,
        string $excerpt,
        string $content,
        string $image,
        CategoryDto $categoryDto,
        Collection $tagDtoCollection,
        Date $published_at
    ) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->content = $content;
        $this->image = $image;
        $this->categoryDto = $categoryDto;
        $this->tagDtoCollection = $tagDtoCollection;
        $this->published_at = $published_at;   
    }


    public function toArray() :array
    {
        $tags = [];
        foreach ($this->tagDtoCollection as $tagDto) {
            $tags[] = $tagDto->toArray();
        }

        return [
            'title' => $this->title,
            'excerpt' => $this->excerpt,
            'content' => $this->content,
            'image' => $this->image,
            'category' => $this->category,
            'published_at' => $this->published_at,
            'tags' => $tags,
        ];
    }


}



