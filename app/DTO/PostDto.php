<?php


namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;

class PostDto
{
    public ?int $id;
    public string $title;
    public string $excerpt;
    public string $content;
    public string $image;
    public Date $published_at;
    public Collection $tagDtoCollection;
    public String $category;


    
    public function __construct(
        int $id,
        string $title,
        string $excerpt,
        string $content,
        string $image,
        string $category,
        Collection $tagDtoCollection,
        Date $published_at
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->content = $content;
        $this->image = $image;
        $this->category = $category;
        $this->tagDtoCollection = $tagDtoCollection;
        $this->published_at = $published_at;   
    }
}



