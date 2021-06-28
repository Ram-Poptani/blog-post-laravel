<?php


namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;

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
}



