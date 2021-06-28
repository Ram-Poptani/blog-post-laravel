<?php


namespace App\DTO;


class CategoryDto
{
    public ?int $id;
    public string $name;


    
    public function __construct(
        ?int $id,
        string $name
    ) {
        $this->id = $id;
        $this->name = $name;
    }

    public function toArray()
    {
        return [
            'name' => $this->name
        ];
    }
}



