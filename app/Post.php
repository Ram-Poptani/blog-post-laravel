<?php

namespace App;

use App\DTO\PostDto;
use App\Helpers\Utils;
use App\Interfaces\PostConstants;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class Post extends Model implements PostConstants
{
    use SoftDeletes;

    protected $dates = [
        'published_at'
    ];

    protected $fillable = [
        'title',
        'excerpt',
        'content',
        'image',
        'published_at',
        'category_id',
        'user_id',

    ];


    /**
     * RELATIONSHIPS
     */

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     *  Helper Functions
     */

    public function deleteImage(){
        Storage::delete($this->image);
    }


    public function hasTag($tag_id)
    {
        return in_array($tag_id, $this->tags->pluck('id')->toArray());
    }


    /**
     * QUERY SCOPES
     */

    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', now());
    }
    public function scopeSearch($query)
    {
        $search = request('search');
        if($search) {
            return $query->where('title', 'like', "%$search%");
        }
        return $query;
    }




    /**
     * Persisting a Post using DTO
     */

    public static function persistPost(PostDto $postDto):self
    {

        // dd($postDto->toArray());

        // 1. Validate
        // Validate the data here
        Utils::validateOrThrow(
            array_diff_key(
                self::CREATE_RULES, 
                [
                    'image' => '',
                    'tags' => ''
                ]
            ), 
            array_diff_key(
                $postDto->toArray(), 
                [
                    'tag_ids' => '', 
                    'user_id' => '', 
                    'image' => ''
                ]
            )
        );
        

        
        // 2. Create
        $post = null;
        DB::transaction(function () use($postDto, &$post) {

            // dd($postDto->toArray());

            $post = Post::create(array_diff_key($postDto->toArray(), ['tag_ids' => '']));
            $post->tags()->attach($postDto->toArray()['tag_ids']);

        });
        // dd($post);
        return $post;



    }


    public static function updatePost(PostDto $postDto):self
    {

        $rules = self::UPDATE_RULES;
        $rules['title'] = $rules['title'].$postDto->id;


        // dd(
        //     array_diff_key(
        //         $postDto->toArray(), 
        //         [
        //             'tag_ids' => '', 
        //             'user_id' => '', 
        //             'image' => ''
        //         ]
        //     )
        // );


        // 1. Validate
        // Validate the data here
        Utils::validateOrThrow(
            array_diff_key(
                $rules, 
                [
                    'image' => '',
                    'tags' => ''
                ]
            ), 
            array_diff_key(
                $postDto->toArray(), 
                [
                    'tag_ids' => '', 
                    'user_id' => '', 
                    'image' => '',
                    'published_at' => '',
                ]
            )
        );
        

        
        // 2. Update
        $post = null;
        DB::transaction(function () use($postDto, &$post) {

            // dd(
            //     array_diff_key(
            //         $postDto->toArray(),
            //         [
            //             'user_id' => '',
            //             'tag_ids' => '',       
            //         ]
            //     )
            // );

            $post = Post::findOrFail($postDto->id);
            $post->update(
                array_diff_key(
                    $postDto->toArray(),
                    [
                        'user_id' => '',
                        'tag_ids' => '',
                    ]
                )
            );
            $post->tags()->sync($postDto->toArray()['tag_ids']);
            

        });
        // dd($post);
        return $post;


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
