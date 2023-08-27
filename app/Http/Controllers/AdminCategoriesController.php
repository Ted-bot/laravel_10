<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:30'
        ]);

        Category::create($request->all());

        session()->flash('message-category-created', 'Category has been created');

        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::query()->where('id', '=', $id)->first();

        return view('admin.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:30'
        ]);

        $category = Category::query()->findOrFail($category->id, 'id');

        $category->update($request->all());

        session()->flash('message-post-updated', "Post has been updated !");

        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nameCategory = Category::query()->findOrFail($id);
        $nameCategoryArray = Category::query()->where('id','=',$id)->first();

        $deleteCategory = $nameCategory->destroy($id);

        if($deleteCategory === 1){
            session()->flash('message-category-deleted', "Category {$nameCategoryArray->name} has been deleted!");
        } elseif ($deleteCategory === 0) {
            session()->flash('message-category-deleted', "Failed deleting Category {$nameCategoryArray->name}!");
        }

        return back();
    }
}
