<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tags\CreateTagRequest;
use App\Http\Requests\Tags\UpdateTagRequest;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        
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
        Tag::create([
            'name'=>$request->name
        ]);

        session()->flash('success', 'Tag Added Successfully!');
        return redirect(route('tags.index'));
    }

    public function destroy(Tag $tag)
    {
        if ( $tag->posts->count() > 0 ) {
            session()->flash('error', 'Tag cannnot be deleted as it is associated with some post!');
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
        $tag->name = $request->name;
        $tag->save();

        session()->flash('success', 'Tag Updated Successfully!');
        return redirect(route('tags.index'));
    }
}
