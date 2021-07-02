<?php

namespace App\Caster;

use App\Collections\CategoryCollection;
use App\DTO\CategoryDto;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Caster;

class CategoryCollectionCaster implements Caster {
    public function cast(mixed $categories):Collection
    {
        return new CategoryCollection(
            array_map(
                function (array $category) {
                    
                    // return new CategoryDto(id: $category['id'], name: $category['name']);
                    return new CategoryDto(...$category);
                },
                $categories->toArray()
            )
        );
    }
}