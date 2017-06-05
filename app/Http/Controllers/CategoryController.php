<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Auth::user()
            ->categories()
            ->where('category_id', '=', null)
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create', [
            'categories' => Category::where('category_id', '=', null)->get(),
        ]);
    }

    /**
     * @param  StoreCategory $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategory $request)
    {
        $category = new Category($request->all());
        $category->user()
            ->associate(Auth::user())
            ->save();

        return redirect()->route('categories.index');
    }

    /**
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
            'categories' => Category::where('category_id', '=', null)->get(),
        ]);
    }

    /**
     * @param  StoreCategory $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategory $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('categories.index');
    }

    /**
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!$category->transactions->isEmpty()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Cannot delete category with transactions');
        }

        if (!$category->budget->isEmpty()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Cannot delete category with an associated budget');
        }

        if (!$category->children->isEmpty()) {
            return redirect()
                ->route('categories.index')
                ->with('error', 'Cannot delete category with child categories');
        }

        $category->delete();

        return redirect()->route('categories.index');
    }
}
