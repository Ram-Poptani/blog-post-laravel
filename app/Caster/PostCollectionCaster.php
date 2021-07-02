<?php

namespace App\Caster;

use App\Collections\PostCollection;
use App\DTO\CategoryDto;
use App\DTO\PostDto;
use Illuminate\Support\Collection;
use Spatie\DataTransferObject\Caster;

class PostCollectionCaster implements Caster {
    public function cast(mixed $posts):Collection
    {
        $tagsCaster = new TagCollectionCaster();
        return new PostCollection(
            array_map(
                function (array $post) use($tagsCaster) {
                    return new PostDto(
                        id: $post['id'],
                        user_id: $post['user_id'],
                        title: $post['title'],
                        excerpt: $post['excerpt'],
                        content: $post['content'],
                        image: $post['image'],
                        published_at: $post['published_at'],
                        tags: $tagsCaster->cast($post['tags']),
                        category: new CategoryDto(
                            id: $post['category']['id'],
                            name: $post['category']['name'],
                        )
                    );
                },
                $posts
            )
        );
    }
}
/**
 *  public ?int $id;
    public int $user_id;
    public string $title;
    public string $excerpt;
    public string $content;
    public ?string $image;
    public ?UploadedFile $imageFile;
    public string $published_at;
    public TagCollection $tags;
    public CategoryDto $category;
 */