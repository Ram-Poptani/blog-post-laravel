<?php


namespace App\Services;

use App\Category;
use App\DTO\CategoryDto;

class CategoryService
{
    public function create(CategoryDto $categoryDto)
    {

        // Wanna derrive some more attributes? You can derrive'em here...

        // dd($categoryDto->toArray());


        Category::persistCategory($categoryDto);
    }



    public function update(CategoryDto $categoryDto)
    {
        Category::updateCategory($categoryDto);
    }

}
