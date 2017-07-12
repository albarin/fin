<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreCategory;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Auth::user()
            ->categories()
            ->parents()
            ->get();

        return view('categories.index', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        return view('categories.create', [
            'categories' => Category::parents()->get(),
        ]);
    }

    public function store(StoreCategory $request)
    {
        $category = new Category($request->all());
        $category->user()
            ->associate(Auth::user())
            ->save();

        return redirect()
            ->route('categories.index')
            ->withSuccess('New category created successfully');
    }

    public function edit(Category $category)
    {
        return view('categories.edit', [
            'category' => $category,
            'categories' => Category::parents()->get(),
        ]);
    }

    public function update(StoreCategory $request, Category $category)
    {
        $category->update($request->all());

        return redirect()
            ->route('categories.index')
            ->withSuccess('Category updated successfully');
    }

    public function destroy(Category $category)
    {
        if ($category->hasTransactions()) {
            return redirect()
                ->route('categories.index')
                ->withWarning('Cannot delete category with transactions');
        }

        if ($category->hasBudget()) {
            return redirect()
                ->route('categories.index')
                ->withWarning('Cannot delete category with budget');
        }

        if ($category->hasChildren()) {
            return redirect()
                ->route('categories.index')
                ->withWarning('Cannot delete category with child categories');
        }

        $category->delete();

        return redirect()
            ->route('categories.index');
    }
}
