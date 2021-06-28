<?php

namespace App;

use App\DTO\CategoryDto;
use App\Helpers\Utils;
use App\Interfaces\CategoryConstants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Category extends Model implements CategoryConstants
{
    protected $fillable = ['name'];

    public function posts(){
        return $this->hasMany(Post::class);
    }


    /**
     * Persisting a Category using DTO
     */


    public static function persistCategory(CategoryDto $categoryDto):self
    {

        // 1. Validate
        // Validate the data here
        Utils::validateOrThrow(
            self::CREATE_RULES, 
            $categoryDto->toArray()
        );
        

        
        // 2. Create
        $category = null;
        DB::transaction(function () use($categoryDto, &$category) {           

            $category = Category::create($categoryDto->toArray());

        });
        return $category;



    }
    


    public static function updateCategory(CategoryDto $categoryDto)
    {
        
        $rules = self::UPDATE_RULES;
        $rules['name'] = $rules['name'].$categoryDto->id;

        Utils::validateOrThrow(
            $rules, 
            $categoryDto->toArray()
        );


        $category = null;
        DB::transaction(function() use($categoryDto, &$category) {
            $category = Category::findOrFail($categoryDto->id);
            $category->name = $categoryDto->name;
            $category->save();
        });
        return $category;
    }




    public static function getCreateValidationRules()
    {
        return self::CREATE_RULES;
    }

    public static function getUpdateValidationRules()
    {
        return self::UPDATE_RULES;
    }
    
}
