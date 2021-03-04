<?php

namespace App\Http\Controllers;

use App\Catagory;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoryRequest;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verifyIsAdmin']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Catagory::all();

        return view('categories.index')->with('categories', $category);
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
        
        Catagory::create([
            'name' => $request->name
        ]);

        session()->flash('success', 'Category created successfully');

        return redirect(route('categories.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Catagory $category)
    {
        return view('categories.create')->with('category', $category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Catagory $category)
    {
        $category->name = $request->name;
        $category->save();

        // Another step for update Method
        // $category->update([
        //     'name' => $request->name
        // ]);

        session()->flash('success', 'Category updated successfully');
        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Catagory $category)
    {
        if($category->posts->count() > 0)
        {
            session()->flash('error', 'Category cannot be deleted because it has some posts.');

            return redirect()->back();
        }

        $category->delete();

        session()->flash('success', 'Category deleted successfully');

        return redirect(route('categories.index'));
    }
}
