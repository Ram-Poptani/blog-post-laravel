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


    public static function persistPost(CategoryDto $categoryDto):self
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
    
}
