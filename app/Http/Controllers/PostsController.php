<?php

namespace App\Http\Controllers;

use App\Caster\TagCollectionCaster;
use App\Category;
use App\DTO\CategoryDto;
use App\DTO\PostDto;
use App\DTO\TagDto;
use App\Http\Requests\Posts\CreatePostRequest;
use App\Http\Requests\Posts\UpdatePostRequest;
use App\Post;
use App\Services\PostService;
use App\Tag;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class PostsController extends Controller
{

    private PostService $postService;


    public function __construct(PostService $ref)
    {

        $this->postService = $ref;


        $this->middleware([
            'verifyCategoriesCount',
        ])->only('create', 'store');

        $this->middleware([
            'validateAuthor',
        ])->only('edit', 'update', 'destroy', 'trash');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = $this->postService->index();

        return view('posts.index', compact([
            'posts',
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.create', compact([
            'categories',
            'tags'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */




    public function store(CreatePostRequest $request)
    {
        
        // TODO: file storing in model
        // $image = $request->file('image')->store('posts');

        $tags = [];
        $tags = array_map(
            function ($tag) use($tags) {
                $temp['id'] = $tag;
                // dd($temp);
                return $tags[] = $temp;
            }, 
            $request->get('tags')
        );
        // dd($tags);
        $tagDtoCollection = (new TagCollectionCaster())->cast($tags);
        // dd($tagDtoCollection);


        $category_id = $request->get('category_id');
        $category = Category::findOrFail($category_id);
        $categoryDto = new CategoryDto([
            'id' => $category_id, 
            'name' => $category->name
        ]);
        // dd($categoryDto);

        $postDto = new PostDto([
            'id' => null,
            'user_id' => auth()->user()->id,
            'title' => $request->get('title'),
            'excerpt' => $request->get('excerpt'),
            'content' => $request->get('content'),
            'category' => $categoryDto,
            'tags' => $tagDtoCollection,
            'published_at' => $request->get('published_at')??now(),
            'imageFile' => $request->file('image') ?? null
        ]);


        try {
            $this->postService->create($postDto);
        }catch(Exception $e) {
            session()->flash('error', 'Errr, Some error while adding Post :/');
            session()->flash('error', $e->getMessage());
            return redirect(route('posts.index'));    
        }

        session()->flash('success', 'Post Created Successfully');
        //redirect
        return redirect(route('posts.index'));

    }
    


    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        
        $categories = Category::all();
        $tags = Tag::all();
        return view('posts.edit', compact(['post', 'categories', 'tags']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */



    public function update(UpdatePostRequest $request, Post $post)
    {

        // dd($request->tags);

        $tags = [];
        $tags = array_map(
            function ($tag) use($tags) {
                $temp['id'] = $tag;
                return $tags[] = $temp;
            }, 
            $request->get('tags')
        );
        // dd($tags);
        $tagDtoCollection = (new TagCollectionCaster())->cast($tags);


        $category_id = $request->get('category_id');
        $category = Category::findOrFail($category_id);
        $categoryDto = new CategoryDto([
            'id' => $category_id, 
            'name' => $category->name
        ]);

        // dd($categoryDto);


        $postDto = new PostDto([
            'id' => $post->id,
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'excerpt' => $request->excerpt,
            'content' => $request->content,
            'image' => $post->image,
            'imageFile' => $request->image ?? null,
            'category' => $categoryDto,
            'tags' => $tagDtoCollection,
            'published_at' => $request->published_at
        ]);


        try {
            $this->postService->update($postDto, $post);
        }catch(Exception $e) {
            session()->flash('error', 'Errr, Some error while updating Post :/');
            // session()->flash('error', $e->getMessage());
            return redirect(route('posts.index'));    
        }

        session()->flash('success', 'Post Updated Successfully');
        //redirect
        return redirect(route('posts.index'));


    }




    /*

    OLD UPDATE FUNCTION

    public function update(UpdatePostRequest $request, Post $post)
    {
        $data = request()->only(['title', 'excerpt', 'content', 'published_at', 'category_id']);
        if($request->hasFile('image')){
            $image = request()->image->store('posts');
            $post->deleteImage();
            $data['image'] = $image;
        }
        $post->update($data);

        $post->tags()->sync($request->tags);

        session()->flash('success', 'Post Updated Successfully!');
        return redirect(route('posts.index'));
    }

    */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::onlyTrashed()->findOrFail($id);
        $post->deleteImage();
        $post->forceDelete();
        session()->flash('success', 'Post Deleted Successfully!');
        return redirect()->back();
    }

    public function trash(Post $post){
        $post->delete();
        session()->flash('success', 'Post trashed successfully!');
        return redirect(route('posts.index'));
    }

    public function trashed(){
        $trashed = Post::onlyTrashed()->paginate(10);
        // dd($trashed);
        return view('posts.trashed')->with('posts', $trashed);
    }

    public function restore($id){
        $trashedPost = Post::onlyTrashed()->findOrFail($id);
        $trashedPost->restore();
        session()->flash('success', 'Post restored successfully!');
        return redirect(route('posts.index'));
    }
}
