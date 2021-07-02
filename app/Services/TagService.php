<?php


namespace App\Services;

use App\Caster\TagCollectionCaster;
use App\DTO\TagDto;
use App\Tag;

class TagService
{
    public function create(TagDto $tagDto)
    {

        // Wanna derrive some more attributes? You can derrive'em here...


        Tag::persistTag($tagDto);
    }

    public function getTags()
    {
        return Tag::all();
    }

    public function makeTagDto(Tag $tag)
    {
        $tagDto = new TagDto([
            'id' => $tag->id, 
            'name' => $tag->name
        ]);
        return $tagDto;
    }

    public function makeTagDtoCollection($tags)
    {
        // $tagDtoCollection = collect();
        // foreach ($tags as $tag) {
        //     $tagDtoCollection->push($this->makeTagDto($tag));
        // }
        // return $tagDtoCollection;

        $tagsCollectionCaster = (new TagCollectionCaster())->cast($tags->toArray());
        return $tagsCollectionCaster;
    }


    public function update(TagDto $tagDto)
    {
        Tag::updateTag($tagDto);
    }
}
