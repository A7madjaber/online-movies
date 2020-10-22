<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Category;
use Validator;

use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function __construct()
{
    $this->middleware('permission:read_categories')->only(['index']);
    $this->middleware('permission:create_categories')->only(['create','store']);
    $this->middleware('permission:update_categories')->only(['edit','update']);
    $this->middleware('permission:delete_categories')->only(['destroy']);

}

    public function index()
    {
        $categories =Category::whenSearch(request()->search)
            ->withCount('movies')
            ->paginate(5);

        return view('dashboard.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        Category::create($request->all());
        session()->flash('success','Data added successfully');
        return redirect()->route('dashboard.categories.index');
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
        return  view('dashboard.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id,
        ]);

        $category->update($request->all());
        session()->flash('success','Data updated successfully');
        return redirect()->route('dashboard.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        session()->flash('success','Data deleted successfully');
        return redirect()->route('dashboard.categories.index');
    }
}
