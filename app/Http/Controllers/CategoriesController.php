<?php

namespace App\Http\Controllers;

use App\Category;
use App\DTO\CategoryDto;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;
use App\Services\CategoryService;
use Exception;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{

    private CategoryService $categoryService;


    public function __construct(CategoryService $ref)
    {

        $this->categoryService = $ref;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact([
            'categories'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {

        $categoryDto = new CategoryDto(null, $request->name);

        try {
            $this->categoryService->create($categoryDto);
        }catch(Exception $e) {
            session()->flash('error', 'Errr, Some error while adding Category :/');
            return redirect(route('categories.index'));    
        }

        session()->flash('success', 'Category Created Successfully');
        //redirect
        return redirect(route('categories.index'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact([
            'category'
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {

        $categoryDto = new CategoryDto($category->id, $request->name);



        try {
            $this->categoryService->update($categoryDto);
        }catch(Exception $e) {
            session()->flash('error', 'Errr, Some error while updating Category :/');
            return redirect(route('categories.index'));    
        }

        session()->flash('success', 'Category Updated Successfully');
        //redirect
        return redirect(route('categories.index'));

        // $category->name = $request->name;
        // $category->save();

        // session()->flash('success', 'Category Updated Successfully!');
        // return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if ( $category->posts->count() > 0 ) {
            session()->flash('error', 'Category cannnot be deleted as it is associated with some post!');
            return redirect()->back();
        }
        $category->delete();
        session()->flash('success', "Category Deleted Successfully");
        return redirect(route('categories.index'));
    }
}
