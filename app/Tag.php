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



    public static function getCreateValidationRules()
    {
        return self::CREATE_RULES;
    }


}
