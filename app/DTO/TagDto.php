<?php


namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;

class TagDto
{
    public ?int $id;
    public string $name;
    public Collection $postDtoCollection;


    
    public function __construct(
        int $id,
        string $name,
        Collection $postDtoCollection
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->postDtoCollection = $postDtoCollection;
    }
}



