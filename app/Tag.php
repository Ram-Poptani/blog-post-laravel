<?php

namespace App;

use App\DTO\TagDto;
use App\Helpers\Utils;
use App\Interfaces\TagConstants;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tag extends Model implements TagConstants
{
    protected $fillable = ['name'];


    public function posts()
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }



    public function getPostCountAttribute()
    {
        return $this->posts->count();
    }



    public static function persistTag(TagDto $tagDto):self
    {

        // 1. Validate
        // Validate the data here
        Utils::validateOrThrow(
            self::CREATE_RULES, 
            $tagDto->toArray()
        );
        

        
        // 2. Create
        $tag = null;
        DB::transaction(function () use($tagDto, &$tag) {           

            $tag = Tag::create($tagDto->toArray());

        });
        return $tag;



    }


    public static function updateTag(TagDto $tagDto)
    {
        
        $rules = self::UPDATE_RULES;
        $rules['name'] = $rules['name'].$tagDto->id;

        Utils::validateOrThrow(
            $rules, 
            $tagDto->toArray()
        );


        $tag = null;
        DB::transaction(function() use($tagDto, &$tag) {
            $tag = Tag::findOrFail($tagDto->id);
            $tag->name = $tagDto->name;
            $tag->save();
        });
        return $tag;
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
