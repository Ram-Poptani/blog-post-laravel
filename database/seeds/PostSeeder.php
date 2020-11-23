<?php

use App\Category;
use App\Post;
use App\Tag;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categoryNews = Category::create([
            'name' => 'News'
        ]);
        $categoryDesign = Category::create([
            'name' => 'Design'
        ]);
        $categoryTechnology = Category::create([
            'name' => 'Technology'
        ]);
        $categoryEngineering = Category::create([
            'name' => 'Engineering'
        ]);



        $tagCustomers = Tag::create([
            'name' => 'customers'
        ]);
        $tagDesign = Tag::create([
            'name' => 'design'
        ]);
        $tagLaravel = Tag::create([
            'name' => 'laravel'
        ]);
        $tagCoding = Tag::create([
            'name' => 'coding'
        ]);


        $post1 = Post::create([
            'title' => 'We relocated our office to HOME!',
            'excerpt' => Faker\Factory::create()->sentence(rand(10, 20)),
            'content' => Faker\Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'posts/1.jpg',
            'category_id' => $categoryDesign->id,
            'user_id' => 2,
            'published_at' => Carbon::now()->format('Y-m-d')
        ]);

        $post2 = Post::create([
            'title' => Faker\Factory::create()->sentence(rand(5, 10)),
            'excerpt' => Faker\Factory::create()->sentence(rand(10, 20)),
            'content' => Faker\Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'posts/2.jpg',
            'category_id' => $categoryDesign->id,
            'user_id' => 3,
            'published_at' => Carbon::now()->format('Y-m-d')
        ]);
        
        $post3 = Post::create([
            'title' => Faker\Factory::create()->sentence(rand(5, 10)),
            'excerpt' => Faker\Factory::create()->sentence(rand(10, 20)),
            'content' => Faker\Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'posts/3.jpg',
            'category_id' => $categoryDesign->id,
            'user_id' => 2,
            'published_at' => Carbon::now()->format('Y-m-d')
        ]);

        $post4 = Post::create([
            'title' => Faker\Factory::create()->sentence(rand(5, 10)),
            'excerpt' => Faker\Factory::create()->sentence(rand(10, 20)),
            'content' => Faker\Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'posts/4.jpg',
            'category_id' => $categoryDesign->id,
            'user_id' => 4,
            'published_at' => Carbon::now()->format('Y-m-d')
        ]);

        $post5 = Post::create([
            'title' => Faker\Factory::create()->sentence(rand(5, 10)),
            'excerpt' => Faker\Factory::create()->sentence(rand(10, 20)),
            'content' => Faker\Factory::create()->paragraphs(rand(3, 7), true),
            'image' => 'posts/5.jpg',
            'category_id' => $categoryDesign->id,
            'user_id' => 3,
            'published_at' => Carbon::now()->format('Y-m-d')
        ]);


        $post1->tags()->attach([$tagCoding->id, $tagLaravel->id]);
        $post2->tags()->attach([$tagCoding->id, $tagCustomers->id, $tagDesign->id]);
        $post3->tags()->attach([$tagDesign->id]);
        $post4->tags()->attach([$tagCoding->id, $tagCustomers->id]);
        $post5->tags()->attach([$tagCoding->id, $tagLaravel->id, $tagCustomers->id, $tagDesign->id]);
    }
}
