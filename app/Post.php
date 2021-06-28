<?php

namespace App;

use App\DTO\PostDto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
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

    public static function persistPost(PostDto $postDto)
    {
        // 1. Validate
        // Validate the data here

        
        // 2. Create




    }



}
