<?php


namespace App\DTO;

use Illuminate\Database\Eloquent\Collection;

class TagDto
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



