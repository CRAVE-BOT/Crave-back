<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Http\Requests\categoryrequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::withcount('products')->paginate(10);
        return view('Theme.Category.category', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Theme.Category.category_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(categoryrequest $request)
    {
     $data = $request->validated();
     $insert=Category::create($data);
        if ($insert) {
            return redirect()->route('Category.index')->with('success', 'Category created successfully');
        }
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
    public function edit(Category $category)
    {
        return view('Theme.Category.category_edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Category $category, Request $request)
    {
        $request->validate([
            'name'=>'required|unique:categories|string',
        ]);
        $category->update(['name' => $request->input('name')]);
            return redirect()->route('Category.index')->with('success', 'Category updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category, Request $request)
    {

        $category->delete();
            return redirect()->route('Category.index')->with('success', 'Category deleted successfully');


    }
}
