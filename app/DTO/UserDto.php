<?php


namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;

class UserDto
{
    public ?int $id;
    public string $name;
    public string $role;
    public Collection $postDtoCollection;
    public Collection $tagDtoCollection;
    public Collection $categoryDtoCollection;


    
    public function __construct(
        int $id,
        string $name,
        string $role,
        Collection $postDtoCollection,
        Collection $tagDtoCollection,
        Collection $categoryDtoCollection
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->role = $role;
        $this->postDtoCollection = $postDtoCollection;
        $this->tagDtoCollection = $tagDtoCollection;
        $this->categoryDtoCollection = $categoryDtoCollection;
    }
}



