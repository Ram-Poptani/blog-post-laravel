<?php

namespace App\Caster;

use App\Collections\TagCollection;
use App\DTO\TagDto;
use App\Tag;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Caster;

class TagCollectionCaster implements Caster {
    public function cast(mixed $tags):Collection
    {
        // dd($tags);
        return new TagCollection(
            array_map(
                function (array $tag) {
                    // dd($tag);
                    return new TagDto(id: $tag['id'], name: Tag::findOrFail($tag['id'])->name);
                    // return new TagDto(...$tag);
                },
                $tags
            )
        );
    }
}