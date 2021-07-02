<?php

namespace App\Http\Controllers;

use App\DTO\TagDto;
use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Services\TagService;
use App\Tag;
use Exception;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    private TagService $tagService;


    public function __construct(TagService $ref)
    {

        $this->tagService = $ref;
    }


    public function index()
    {
        $tags = Tag::all();

        $tagDtoCollection = $this->tagService->makeTagDtoCollection($tags);
        $tags = $tagDtoCollection;
        
        return view('tags.index', compact([
            'tags'
        ]));
    }

    public function create()
    {
        return view('tags.create');
    }

    public function store(CreateTagRequest $request)
    {

        $tagDto = new TagDto([
            'id' => null, 
            'name' => $request->name,
        ]);

        try {
            $this->tagService->create($tagDto);
        }catch(Exception $e) {
            session()->flash('error', 'Errr, Some error while adding Tag :/');
            // session()->flash('error', $e->getMessage());
            return redirect(route('tags.index'));    
        }

        session()->flash('success', 'Tag Created Successfully');
        //redirect
        return redirect(route('tags.index'));


        // Tag::create([
        //     'name'=>$request->name
        // ]);

        // session()->flash('success', 'Tag Added Successfully!');
        // return redirect(route('tags.index'));
    }

    public function destroy(Tag $tag)
    {
        if ( $tag->posts->count() > 0 ) {
            session()->flash('error', 'Tag cannnot be deleted as it is associated with some post!');
            // session()->flash('error', $e->getMessage());
            return redirect()->back();
        }
        $tag->delete();
        session()->flash('success', "Tag Deleted Successfully");
        return redirect(route('tags.index'));
    }

    public function edit(Tag $tag)
    {
        // dd(tag)
        return view('tags.edit', compact([
            'tag'
        ]));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // dd($tag);


        $tagDto = new TagDto([
            'id' => $tag->id, 
            'name' => $request->name,
        ]);



        try {
            $this->tagService->update($tagDto);
        }catch(Exception $e) {
            session()->flash('error', 'Errr, Some error while updating Tag :/');
            // session()->flash('error', $e->getMessage());
            return redirect(route('tags.index'));    
        }

        session()->flash('success', 'Tag Updated Successfully');
        //redirect
        return redirect(route('tags.index'));


        // $tag->name = $request->name;
        // $tag->save();

        // session()->flash('success', 'Tag Updated Successfully!');
        // return redirect(route('tags.index'));
    }
}
