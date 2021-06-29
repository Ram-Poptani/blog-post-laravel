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


    public function getCategories()
    {
        return Category::all();
    }

    public function makeCategoryDto($category)
    {
        return new CategoryDto($category->id, $category->name);

    }

    public function makeCategoryDtoCollection($categories)
    {
        $categoryDtoCollection = collect();
        foreach ($categories as $category) {
            $categoryDtoCollection->push($this->makeCategoryDto($category));
        }
        return $categoryDtoCollection;
    }



    public function update(CategoryDto $categoryDto)
    {
        Category::updateCategory($categoryDto);
    }

}
