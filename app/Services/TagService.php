<?php


namespace App\Services;

use App\DTO\TagDto;
use App\Tag;

class TagService
{
    public function create(TagDto $tagDto)
    {

        // Wanna derrive some more attributes? You can derrive'em here...


        Tag::persistPost($tagDto);
    }
}