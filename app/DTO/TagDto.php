<?php


namespace App\DTO;

use App\Services\TagService;
use App\Tag;
use Spatie\DataTransferObject\DataTransferObject;

class TagDto extends DataTransferObject
{
    public ?int $id;
    public string $name;


    public function getPostCount()
    {
        return Tag::findOrFail($this->id)->postCount;
    }
    
    // public function __construct(
    //     ?int $id,
    //     string $name
    // ) {
    //     $this->id = $id;
    //     $this->name = $name;
    // }

    // public function toArray()
    // {
    //     return ['name' => $this->name];
    // }
}



