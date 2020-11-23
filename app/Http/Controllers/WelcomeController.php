<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{

    public function index()
    {
        $tags = Tag::all();
        $posts = Post::search()->published()->simplePaginate(2);
        // $posts = Post::simplePaginate(2);
        $categories = Category::all();

        return view('blog.index', compact([
            'tags',
            'posts',
            'categories'
        ]));
    }

    public function show(Post $post)
    {
        // dd($post);
        // dd(view('blog.post'));
        $categories = Category::all();
        $tags = Tag::all();
        return view('blog.post', compact([
            'post',
            'tags',
            'categories'
        ]));
    }

    public function category(Category $category)
    {
        $tags = Tag::all();
        // $posts = $category->posts()->simplePaginate(2);
        $posts = $category->posts()->search()->published()->simplePaginate(2);
        $categories = Category::all();

        return view('blog.index', compact([
            'tags',
            'posts',
            'categories'
        ]));
    }

    public function tag(Tag $tag)
    {
        $tags = Tag::all();
        $posts = $tag->posts()->search()->published()->simplePaginate(2);
        // $posts = $tag->posts()->simplePaginate(2);
        $categories = Category::all();

        return view('blog.index', compact([
            'tags',
            'posts',
            'categories'
        ]));
    }
}
